<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRequestResource\Pages;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\CustomerVehicle;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Service Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Request Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->options(User::customers()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('vehicle_id', null)),
                        Forms\Components\Select::make('vehicle_id')
                            ->label('Vehicle')
                            ->options(function (callable $get) {
                                $customerId = $get('user_id');
                                if (!$customerId) return [];
                                return CustomerVehicle::where('user_id', $customerId)
                                    ->with('vehicle')
                                    ->get()
                                    ->mapWithKeys(fn($cv) => [$cv->id => "{$cv->vehicle->brand} {$cv->vehicle->model} ({$cv->license_plate})"]);
                            })
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('service_id')
                            ->label('Service')
                            ->options(Service::pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('technician_id')
                            ->label('Technician')
                            ->options(User::technicians()->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Schedule & Status')
                    ->schema([
                        Forms\Components\DateTimePicker::make('scheduled_datetime')
                            ->required()
                            ->native(false),
                        Forms\Components\DateTimePicker::make('completion_datetime')
                            ->native(false),
                        Forms\Components\Select::make('status')
                            ->options([
                                ServiceRequest::STATUS_PENDING => 'Pending',
                                ServiceRequest::STATUS_CONFIRMED => 'Confirmed',
                                ServiceRequest::STATUS_IN_PROGRESS => 'In Progress',
                                ServiceRequest::STATUS_COMPLETED => 'Completed',
                                ServiceRequest::STATUS_CANCELLED => 'Cancelled',
                            ])
                            ->required()
                            ->default(ServiceRequest::STATUS_PENDING)
                            ->native(false),
                        Forms\Components\Textarea::make('customer_notes')
                            ->rows(3)
                            ->maxLength(1000),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.license_plate')
                    ->label('Vehicle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => ServiceRequest::STATUS_PENDING,
                        'info' => ServiceRequest::STATUS_CONFIRMED,
                        'primary' => ServiceRequest::STATUS_IN_PROGRESS,
                        'success' => ServiceRequest::STATUS_COMPLETED,
                        'danger' => ServiceRequest::STATUS_CANCELLED,
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('scheduled_datetime')
                    ->label('Scheduled')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technician.name')
                    ->label('Technician')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        ServiceRequest::STATUS_PENDING => 'Pending',
                        ServiceRequest::STATUS_CONFIRMED => 'Confirmed',
                        ServiceRequest::STATUS_IN_PROGRESS => 'In Progress',
                        ServiceRequest::STATUS_COMPLETED => 'Completed',
                        ServiceRequest::STATUS_CANCELLED => 'Cancelled',
                    ])
                    ->native(false),
                SelectFilter::make('service_id')
                    ->label('Service')
                    ->options(Service::pluck('name', 'id'))
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('scheduled_datetime', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServiceRequests::route('/'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerVehicleResource\Pages;
use App\Models\CustomerVehicle;
use App\Models\User;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class CustomerVehicleResource extends Resource
{
    protected static ?string $model = CustomerVehicle::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Vehicle Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Owner Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->options(User::customers()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),
                    ]),

                Forms\Components\Section::make('Vehicle Information')
                    ->schema([
                        Forms\Components\Select::make('vehicle_id')
                            ->label('Vehicle')
                            ->options(Vehicle::all()->mapWithKeys(fn($v) => [$v->id => "{$v->brand} {$v->model}"]))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('year')
                            ->required()
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y') + 1),
                        Forms\Components\TextInput::make('license_plate')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        Forms\Components\TextInput::make('color')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('vin_number')
                            ->label('VIN Number')
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Owner')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.brand')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.model')
                    ->label('Model')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('license_plate')
                    ->label('License Plate')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_requests_count')
                    ->counts('serviceRequests')
                    ->label('Services')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('vehicle.brand')
                    ->label('Brand')
                    ->options(Vehicle::distinct('brand')->pluck('brand', 'brand'))
                    ->searchable(),
                SelectFilter::make('year')
                    ->options(collect(range(date('Y'), 1990))->mapWithKeys(fn($y) => [$y => $y])),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomerVehicles::route('/'),
        ];
    }
}

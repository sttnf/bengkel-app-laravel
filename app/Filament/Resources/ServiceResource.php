<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Service Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Service Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category')
                            ->options([
                                'Maintenance' => 'Maintenance',
                                'Repair' => 'Repair',
                                'Performance' => 'Performance',
                                'Safety' => 'Safety',
                                'Electrical' => 'Electrical',
                                'Engine' => 'Engine',
                                'Transmission' => 'Transmission',
                                'Brakes' => 'Brakes',
                                'Suspension' => 'Suspension',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->maxLength(1000),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Duration')
                    ->schema([
                        Forms\Components\TextInput::make('base_price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        Forms\Components\TextInput::make('estimated_hours')
                            ->required()
                            ->numeric()
                            ->suffix('hours')
                            ->step(0.5)
                            ->minValue(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'Maintenance',
                        'success' => 'Repair',
                        'warning' => 'Performance',
                        'danger' => 'Safety',
                        'secondary' => 'Other',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('base_price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_hours')
                    ->suffix(' hrs')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_requests_count')
                    ->counts('serviceRequests')
                    ->label('Requests')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Maintenance' => 'Maintenance',
                        'Repair' => 'Repair',
                        'Performance' => 'Performance',
                        'Safety' => 'Safety',
                        'Electrical' => 'Electrical',
                        'Engine' => 'Engine',
                        'Transmission' => 'Transmission',
                        'Brakes' => 'Brakes',
                        'Suspension' => 'Suspension',
                        'Other' => 'Other',
                    ])
                    ->native(false),
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
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServices::route('/'),
        ];
    }
}

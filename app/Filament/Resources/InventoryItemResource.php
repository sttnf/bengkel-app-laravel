<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryItemResource\Pages;
use App\Models\InventoryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class InventoryItemResource extends Resource
{
    protected static ?string $model = InventoryItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Inventory Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Item Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category')
                            ->options([
                                'Parts' => 'Parts',
                                'Lubricants' => 'Lubricants',
                                'Filters' => 'Filters',
                                'Tools' => 'Tools',
                                'Consumables' => 'Consumables',
                                'Electronics' => 'Electronics',
                                'Accessories' => 'Accessories',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('part_number')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Stock')
                    ->schema([
                        Forms\Components\TextInput::make('unit_price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        Forms\Components\TextInput::make('current_stock')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('reorder_level')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\TextInput::make('unit')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('pcs, liter, kg, etc.'),
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
                        'primary' => 'Parts',
                        'success' => 'Lubricants',
                        'warning' => 'Filters',
                        'info' => 'Tools',
                        'secondary' => 'Other',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('part_number')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_stock')
                    ->badge()
                    ->color(fn (InventoryItem $record): string => 
                        $record->isLowStock() ? 'danger' : 'success'
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('supplier')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('low_stock')
                    ->boolean()
                    ->getStateUsing(fn (InventoryItem $record): bool => $record->isLowStock())
                    ->label('Low Stock')
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->falseIcon('heroicon-o-check-circle'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Parts' => 'Parts',
                        'Lubricants' => 'Lubricants',
                        'Filters' => 'Filters',
                        'Tools' => 'Tools',
                        'Consumables' => 'Consumables',
                        'Electronics' => 'Electronics',
                        'Accessories' => 'Accessories',
                        'Other' => 'Other',
                    ])
                    ->native(false),
                Tables\Filters\Filter::make('low_stock')
                    ->query(fn (Builder $query): Builder => $query->lowStock())
                    ->label('Low Stock Items'),
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
            'index' => Pages\ManageInventoryItems::route('/'),
        ];
    }
}

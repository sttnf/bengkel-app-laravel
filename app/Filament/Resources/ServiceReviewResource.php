<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceReviewResource\Pages;
use App\Models\ServiceReview;
use App\Models\ServiceRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ServiceReviewResource extends Resource
{
    protected static ?string $model = ServiceReview::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Service Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Review Information')
                    ->schema([
                        Forms\Components\Select::make('request_id')
                            ->label('Service Request')
                            ->options(ServiceRequest::with(['user', 'service'])
                                ->whereDoesntHave('review')
                                ->get()
                                ->mapWithKeys(fn($sr) => [
                                    $sr->id => "#{$sr->id} - {$sr->user->name} - {$sr->service->name}"
                                ]))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('rating')
                            ->options([
                                1 => '1 Star - Poor',
                                2 => '2 Stars - Fair',
                                3 => '3 Stars - Good',
                                4 => '4 Stars - Very Good',
                                5 => '5 Stars - Excellent',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\Textarea::make('review_text')
                            ->rows(4)
                            ->maxLength(1000),
                        Forms\Components\DateTimePicker::make('review_date')
                            ->default(now())
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serviceRequest.user.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serviceRequest.service.name')
                    ->label('Service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->badge()
                    ->colors([
                        'danger' => fn ($state): bool => $state <= 2,
                        'warning' => fn ($state): bool => $state == 3,
                        'success' => fn ($state): bool => $state >= 4,
                    ])
                    ->formatStateUsing(fn (int $state): string => $state . ' ⭐')
                    ->sortable(),
                Tables\Columns\TextColumn::make('review_text')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('review_date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->native(false),
                SelectFilter::make('service_id')
                    ->label('Service')
                    ->relationship('serviceRequest.service', 'name')
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
            ->defaultSort('review_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServiceReviews::route('/'),
        ];
    }
}

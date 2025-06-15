<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\ServiceRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Financial Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('request_id')
                            ->label('Service Request')
                            ->options(ServiceRequest::with(['user', 'service'])
                                ->get()
                                ->mapWithKeys(fn($sr) => [
                                    $sr->id => "#{$sr->id} - {$sr->user->name} - {$sr->service->name}"
                                ]))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0),
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                Payment::METHOD_CASH => 'Cash',
                                Payment::METHOD_QRIS => 'QRIS',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('status')
                            ->options([
                                Payment::STATUS_PENDING => 'Pending',
                                Payment::STATUS_COMPLETED => 'Completed',
                                Payment::STATUS_FAILED => 'Failed',
                                Payment::STATUS_REFUNDED => 'Refunded',
                            ])
                            ->required()
                            ->default(Payment::STATUS_PENDING)
                            ->native(false),
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
                Tables\Columns\TextColumn::make('serviceRequest.user.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serviceRequest.service.name')
                    ->label('Service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('payment_method')
                    ->colors([
                        'success' => Payment::METHOD_CASH,
                        'info' => Payment::METHOD_QRIS,
                    ])
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => Payment::STATUS_PENDING,
                        'success' => Payment::STATUS_COMPLETED,
                        'danger' => Payment::STATUS_FAILED,
                        'secondary' => Payment::STATUS_REFUNDED,
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        Payment::STATUS_PENDING => 'Pending',
                        Payment::STATUS_COMPLETED => 'Completed',
                        Payment::STATUS_FAILED => 'Failed',
                        Payment::STATUS_REFUNDED => 'Refunded',
                    ])
                    ->native(false),
                SelectFilter::make('payment_method')
                    ->options([
                        Payment::METHOD_CASH => 'Cash',
                        Payment::METHOD_QRIS => 'QRIS',
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}

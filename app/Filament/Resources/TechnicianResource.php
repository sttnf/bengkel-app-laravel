<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicianResource\Pages;
use App\Models\Technician;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class TechnicianResource extends Resource
{
    protected static ?string $model = Technician::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Technician Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('User')
                            ->options(User::technicians()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('specialization')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('experience_years')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->suffix('years'),
                        Forms\Components\TagsInput::make('skills')
                            ->placeholder('Add skills...')
                            ->helperText('Press Enter to add each skill'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialization')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('experience_years')
                    ->suffix(' yrs')
                    ->sortable(),
                Tables\Columns\TagsColumn::make('skills')
                    ->limit(3),
                Tables\Columns\TextColumn::make('service_requests_count')
                    ->counts('serviceRequests')
                    ->label('Assigned Jobs')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('specialization')
                    ->options(Technician::distinct('specialization')->pluck('specialization', 'specialization'))
                    ->searchable(),
                SelectFilter::make('experience_years')
                    ->options([
                        '0-1' => '0-1 years',
                        '2-5' => '2-5 years',
                        '6-10' => '6-10 years',
                        '10+' => '10+ years',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function (Builder $query, string $value): Builder {
                            return match ($value) {
                                '0-1' => $query->whereBetween('experience_years', [0, 1]),
                                '2-5' => $query->whereBetween('experience_years', [2, 5]),
                                '6-10' => $query->whereBetween('experience_years', [6, 10]),
                                '10+' => $query->where('experience_years', '>=', 10),
                                default => $query,
                            };
                        });
                    }),
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
            ->defaultSort('user.name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTechnicians::route('/'),
        ];
    }
}

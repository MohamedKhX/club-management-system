<?php

namespace App\Filament\SportFederation\Resources;

use App\Filament\SportFederation\Resources\PlayerResource\Pages;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers;
use App\Models\Club;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayerResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'iconpark-sport';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date_of_birth')
                    ->label(__('Date of Birth'))
                    ->sortable(),

                TextColumn::make('position')
                    ->label(__('Position'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nationality')
                    ->label(__('Nationality'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('club.name')
                    ->label(__('Club'))
                    ->badge()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('club_id')
                    ->label(__('Club'))
                    ->options(
                        Club::pluck('name', 'id')->toArray()
                    ),
                ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }
}

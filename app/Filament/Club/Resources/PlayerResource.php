<?php

namespace App\Filament\Club\Resources;

use App\Enums\PlayerStateEnum;
use App\Filament\Club\Resources\PlayerResource\Pages;
use App\Filament\Club\Resources\PlayerResource\RelationManagers;
use App\Models\Club;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PlayerResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'iconpark-sport';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label("Player Avatar")
                    ->translateLabel()
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('state')
                    ->label(__('State'))
                    ->sortable()
                    ->badge()
                    ->color(fn (Model $record) => $record->state === PlayerStateEnum::Active ? Color::Green : Color::Red)
                    ->formatStateUsing(fn($state) => $state->translate()),

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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('club_id')
                    ->label(__('Club'))
                    ->options(
                        Club::pluck('name', 'id')->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('show_contract')
                    ->label('Show Contract')
                    ->translateLabel()
                    ->color(Color::Green)
                    ->icon('iconpark-eyes')
                    ->url(fn (Player $player) => $player->getFirstMediaUrl('contract'), true),
            ]);
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit'   => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}

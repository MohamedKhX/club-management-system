<?php

namespace App\Filament\Club\Resources;

use App\Enums\PlayerStateEnum;
use App\Filament\Club\Resources\PlayerResource\Pages;
use App\Filament\Club\Resources\PlayerResource\RelationManagers;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers\ContractsRelationManager;
use App\Models\Club;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
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


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()
                    ->label("Info")
                    ->translateLabel()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        DatePicker::make('date_of_birth')
                            ->label('Date Of Birth')
                            ->translateLabel()
                            ->required(),

                        TextInput::make('position')
                            ->label('Position')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label('Player Avatar')
                            ->translateLabel()
                            ->image(),

                        Forms\Components\Hidden::make('sport_federation_id')
                            ->default(Filament::auth()->user()->sport_federation_id),
                    ])
                    ->columns(1)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label("Player Avatar")
                    ->translateLabel()
                    ->collection('avatar')
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
                Tables\Actions\ViewAction::make()
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
            ContractsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit'   => Pages\EditPlayer::route('/{record}/edit'),
            'view'   => Pages\ViewPlayer::route('/{record}'),
        ];
    }
}

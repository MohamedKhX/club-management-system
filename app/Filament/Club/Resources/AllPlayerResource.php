<?php

namespace App\Filament\Club\Resources;

use App\Filament\Club\Resources\AllPlayerResource\Pages;
use App\Filament\Club\Resources\AllPlayerResource\RelationManagers;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers\ContractsRelationManager;
use App\Models\AllPlayer;
use App\Models\Club;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AllPlayerResource extends Resource
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
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),


                        TextInput::make('grandfather_name')
                            ->label('Grandfather Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        TextInput::make('national_number')
                            ->label('National Number')
                            ->translateLabel()
                            ->numeric()
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

                        TextInput::make('tunic_number')
                            ->label('Tunic Number')
                            ->translateLabel()
                            ->numeric()
                            ->maxLength(100)
                            ->required(),

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

                        SpatieMediaLibraryFileUpload::make('birth_certificate')
                            ->collection('birth_certificate')
                            ->label('Birth Certificate')
                            ->translateLabel()
                            ->image(),

                        SpatieMediaLibraryFileUpload::make('passport')
                            ->collection('passport')
                            ->label('Passport')
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
                    ->label('Name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date_of_birth')
                    ->label('Date of Birth')
                    ->translateLabel()
                    ->sortable(),

                TextColumn::make('position')
                    ->label('Position')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nationality')
                    ->label('Nationality')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nationality')
                    ->label('Nationality')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),


                TextColumn::make('followingClub')
                    ->label('Club')
                    ->translateLabel()
                    ->badge()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
            ]);
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
            'index' => Pages\ListAllPlayers::route('/'),
            'create' => Pages\CreateAllPlayer::route('/create'),
            'edit' => Pages\EditAllPlayer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->club->sport_federation_id);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canView(Model $record): bool
    {
        return true;
    }

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function getPluralLabel(): ?string
    {
        return 'كل اللاعبين';
    }

    public static function getNavigationLabel(): string
    {
        return 'كل اللاعبين';
    }

    public function getHeading(): string|Htmlable
    {
        return 'كل اللاعبين';
    }
}

<?php

namespace App\Filament\SportFederation\Resources;

use App\Enums\RequestStatus;
use App\Filament\SportFederation\Resources\PlayerResource\Pages;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers;
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
use Illuminate\Database\Eloquent\Builder;

class PlayerResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Player::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }

    protected static ?string $navigationIcon = 'iconpark-sport';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label("Player Avatar")
                    ->collection('avatar')
                    ->translateLabel()
                    ->circular(),

                TextColumn::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->searchable(query: function ($query, $search) {
                        $query->where(function ($query) use ($search) {
                            $query->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    }),

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

                TextColumn::make('followingClub')
                    ->label('Club')
                    ->translateLabel()
                    ->badge()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ]);
    }

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
                            ->image()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('birth_certificate')
                            ->collection('birth_certificate')
                            ->label('Birth Certificate')
                            ->translateLabel()
                            ->image()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('passport')
                            ->collection('passport')
                            ->label('Passport')
                            ->translateLabel()
                            ->image()
                            ->required(),

                        Forms\Components\Hidden::make('sport_federation_id')
                            ->default(Filament::auth()->user()->sport_federation_id),
                    ])
                ->columns(1)
            ])->columns(1);
    }






























    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContractsRelationManager::make()
        ];
    }


}

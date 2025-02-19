<?php

namespace App\Filament\SportFederation\Resources;

use App\Enums\ClubTypeEnum;
use App\Filament\SportFederation\Resources\ClubResource\Pages;
use App\Filament\SportFederation\Resources\ClubResource\RelationManagers;
use App\Models\Club;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClubResource extends Resource
{
    use HasTranslatedLabels;


    protected static ?string $model = Club::class;
    protected static ?string $navigationIcon = 'tabler-clubs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Club Name')) // Translate label
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('Enter the club name')), // Translation for placeholder

                                TextInput::make('location')
                                    ->label(__('Location')) // Translate label
                                    ->placeholder(__('Enter the club location')), // Translation for placeholder
                            ]),

                        Select::make('type')
                            ->label('Type')
                            ->translateLabel()
                            ->options(ClubTypeEnum::getTranslations())
                            ->searchable()
                            ->required(),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->translateLabel()
                            ->required()
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(10),


                        TextInput::make('email')
                            ->label('Email')
                            ->translateLabel()
                            ->required()
                            ->email(),

                        TextInput::make('website')
                            ->label('Website')
                            ->translateLabel(),

                        TextInput::make('facebook_page')
                            ->label('Facebook Page')
                            ->translateLabel()
                            ->nullable(),

                        TextInput::make('twitter_page')
                            ->label('Twitter Page')
                            ->translateLabel()
                            ->nullable(),

                        DatePicker::make('founded_date')
                            ->label(__('Founded Year')) // Translate label
                            ->placeholder(__('Select the year the club was founded')) // Translation for placeholder
                            ->displayFormat('Y'),

                        Textarea::make('description')
                            ->label(__('Description')) // Translate label
                            ->rows(4)
                            ->placeholder(__('Enter a brief description about the club')), // Translation for placeholder


                        SpatieMediaLibraryFileUpload::make('logo')
                            ->label('Logo')
                            ->translateLabel()
                            ->required(),

                        Hidden::make('sport_federation_id')
                            ->default(auth()->user()->sport_federation_id), // Hidden field for sport federation ID
                    ])
                    ->columns(1) // Aligns the layout within a single card
                    ->label(__('Club Information')), // Translation for card label
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->label("Logo")
                    ->translateLabel()
                    ->circular(),

                TextColumn::make('name')
                    ->label('Club Name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable()
                    ->description(fn($record) => $record->description)
                    ->limit(50),

                TextColumn::make('type')
                    ->label('Type')
                    ->translateLabel()
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state->translate()),


                TextColumn::make('location')
                    ->label('Location')
                    ->translateLabel()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('founded_date')
                    ->label('Founded Date')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }


























    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}

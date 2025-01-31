<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SportFederationResource\RelationManagers\UsersRelationManager;
use App\Models\SportFederation;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
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

class SportFederationResource extends Resource
{
    protected static ?string $navigationIcon = 'fluentui-sport-24-o';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->label("Info")
                    ->translateLabel()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->translateLabel()
                            ->required()
                            ->maxLength(100),

                        Textarea::make('description')
                            ->label('Description')
                            ->translateLabel()
                            ->required()
                            ->maxLength(100),

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

                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->label('Logo')
                            ->translateLabel()
                            ->required(),
                    ])
                    ->columns(1),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->label("Logo")
                    ->translateLabel()
                    ->collection('logo')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->description(fn($record) => $record->description)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->translateLabel(),

                TextColumn::make('email')
                    ->label('Email')
                    ->translateLabel(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }














    use HasTranslatedLabels;

    protected static ?string $model = SportFederation::class;

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\SportFederationResource\Pages\ListSportFederations::route('/'),
            'create' => \App\Filament\Admin\Resources\SportFederationResource\Pages\CreateSportFederation::route('/create'),
            'edit' => \App\Filament\Admin\Resources\SportFederationResource\Pages\EditSportFederation::route('/{record}/edit'),
        ];
    }
}

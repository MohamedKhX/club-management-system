<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\SportFederationResource\Pages;
use App\Filament\Resources\SportFederationResource\RelationManagers;
use App\Models\SportFederation;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\HasRelationManagers;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SportFederationResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = SportFederation::class;

    protected static ?string $navigationIcon = 'fluentui-sport-24-o';

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
                    ])
                    ->columns(1),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->translateLabel()
                    ->description(fn($record) => $record->description)
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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

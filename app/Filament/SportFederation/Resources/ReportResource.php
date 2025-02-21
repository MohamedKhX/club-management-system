<?php

namespace App\Filament\SportFederation\Resources;

use App\Filament\SportFederation\Resources\ReportResource\Pages;
use App\Filament\SportFederation\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{

    use HasTranslatedLabels;
    protected static ?string $model = Report::class;


    protected static ?string $navigationIcon = 'tabler-message-report';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                TextColumn::make('content')
                    ->label(__('Content'))
                    ->limit(100)
                    ->wrap(),

                TextColumn::make('club.name')
                    ->label(__('Club'))
                    ->sortable()
                    ->searchable()
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->disabled(fn($record) => $record->club)
                    ->hidden(fn($record) => $record->club),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn($record) => $record->club)
                    ->hidden(fn($record) => $record->club),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->translateLabel()
                            ->required(),

                        Forms\Components\Textarea::make('content')
                            ->label('Content')
                            ->translateLabel()
                            ->required(),

                        Hidden::make('sport_federation_id')
                            ->default(auth()->user()->sport_federation_id),
                    ])->columns(1)
            ]);
    }


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }































    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }


}

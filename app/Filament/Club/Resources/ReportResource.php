<?php

namespace App\Filament\Club\Resources;

use App\Filament\Club\Resources\ReportResource\Pages;
use App\Filament\Club\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'tabler-message-report';

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

                            Hidden::make('club_id')
                                ->default(auth()->user()->club_id),

                            Hidden::make('sport_federation_id')
                                ->default(auth()->user()->club->sport_federation_id),
                        ])->columns(1)
            ]);
    }

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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ]);
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
            'index' => Pages\ListReports::route('/'),
           /* 'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),*/
        ];
    }
}

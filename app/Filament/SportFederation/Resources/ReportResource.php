<?php

namespace App\Filament\SportFederation\Resources;

use App\Filament\SportFederation\Resources\ReportResource\Pages;
use App\Filament\SportFederation\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
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
            ]);
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

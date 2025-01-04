<?php

namespace App\Filament\SportFederation\Resources;

use App\Filament\SportFederation\Resources\RequestResource\Pages;
use App\Filament\SportFederation\Resources\RequestResource\RelationManagers;
use App\Models\Request;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestResource extends Resource
{
    use HasTranslatedLabels;
    protected static ?string $model = Request::class;

    protected static ?string $navigationIcon = 'tabler-git-pull-request';

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
                TextColumn::make('player.name')
                    ->label('Player')
                    ->translateLabel()
                    ->searchable(),

                TextColumn::make('club.name')
                    ->label('Club')
                    ->translateLabel()
                    ->searchable(),

                TextColumn::make('state')
                    ->label('State')
                    ->translateLabel()
                    ->formatStateUsing(fn($state) => $state->translate())
                    ->badge(),

                TextColumn::make('type')
                    ->label('Type')
                    ->translateLabel()
                    ->formatStateUsing(fn($state) => $state->translate())
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }
}

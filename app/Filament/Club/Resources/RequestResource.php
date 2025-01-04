<?php

namespace App\Filament\Club\Resources;

use App\Enums\RequestStateEnum;
use App\Enums\RequestTypeEnum;
use App\Filament\Club\Resources\RequestResource\Pages;
use App\Filament\Club\Resources\RequestResource\RelationManagers;
use App\Models\Player;
use App\Models\Request;
use App\Traits\HasTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Request::class;

    protected static ?string $navigationIcon = 'tabler-git-pull-request';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->translateLabel()
                            ->options(RequestTypeEnum::getTranslations())
                            ->required(),

                        Select::make('player_id')
                            ->label('Player')
                            ->translateLabel()
                            ->options(Player::pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        Textarea::make('description')
                            ->label('Description')
                            ->translateLabel()
                            ->rows(4)
                            ->nullable(),

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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Club\Resources;

use App\Enums\RequestTypeEnum;
use App\Filament\Club\Resources\RequestResource\Pages;
use App\Models\Player;
use App\Models\Request;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RequestResource extends Resource
{
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
                            ->required()
                            ->live(),

                        Select::make('player_id')
                            ->label('Player')
                            ->translateLabel()
                            ->options(
                                Player::selectRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, id")
                                    ->pluck('full_name', 'id')
                            )
                            ->searchable()
                            ->required()
                            ->disabled(fn($get) => $get('type') == RequestTypeEnum::PlayerRegistration->value)
                            ->hidden(fn($get) => $get('type') == RequestTypeEnum::PlayerRegistration->value),

                        Textarea::make('description')
                            ->label('Description')
                            ->translateLabel()
                            ->rows(4)
                            ->nullable()
                            ->disabled(fn($get) => $get('type') == RequestTypeEnum::PlayerRegistration->value)
                            ->hidden(fn($get) => $get('type') == RequestTypeEnum::PlayerRegistration->value),

                        SpatieMediaLibraryFileUpload::make('Contract')
                            ->collection('contract')
                            ->label('Contract')
                            ->translateLabel()
                            ->hidden(fn($get) => $get('type') == RequestTypeEnum::PlayerRegistration->value),

                        Hidden::make('sport_federation_id')
                            ->default(auth()->user()->club->sport_federation_id),

                        Forms\Components\Section::make('player')
                            ->heading('بيانات اللاعب')
                            ->statePath('player')
                            ->schema(function() use($form) {
                                return [
                                    ... PlayerResource::getFormSchema(true)
                                ];
                            })
                            ->disabled(fn($get) => $get('type') != RequestTypeEnum::PlayerRegistration->value)
                            ->hidden(fn($get) => $get('type') != RequestTypeEnum::PlayerRegistration->value),

                        Hidden::make('club_id')
                            ->default(auth()->user()->club_id),

                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('player.name')
                    ->label('Type')
                    ->translateLabel()
                    ->description(fn($record) => $record->description),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->translateLabel()
                    ->badge()
                    ->formatStateUsing(fn($state) => $state->translate()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->mutateRecordDataUsing(function ($record) {
                        return $record->toArray();
                }),
            ]);
    }



























    use HasTranslatedLabels;

    protected static ?string $model = Request::class;


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('club_id', Filament::auth()->user()->club_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}

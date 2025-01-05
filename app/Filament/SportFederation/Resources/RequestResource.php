<?php

namespace App\Filament\SportFederation\Resources;

use App\Enums\RequestStateEnum;
use App\Filament\SportFederation\Resources\RequestResource\Pages;
use App\Filament\SportFederation\Resources\RequestResource\RelationManagers;
use App\Models\Club;
use App\Models\Contract;
use App\Models\Request;
use App\Models\SportFederation;
use App\Notifications\NewRequest;
use App\Notifications\RequestApproved;
use App\Notifications\RequestRejected;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
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
                    ->searchable()
                ,

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
                Tables\Actions\Action::make('show_contract')
                    ->label('Show Contract')
                    ->translateLabel()
                    ->color(Color::Green)
                    ->icon('iconpark-eyes')
                    ->url(fn (Request $request) => $request->getFirstMediaUrl('contract'), true),

                Tables\Actions\Action::make('open_player_page')
                    ->label('Open Player Page')
                    ->translateLabel()
                    ->icon('tabler-link')
                    ->color(Color::Emerald)
                    ->url(fn (Request $request) => PlayerResource::getUrl('edit', [$request->player_id]), true),

                Tables\Actions\Action::make('edit_state')
                    ->label('Edit State')
                    ->translateLabel()
                    ->icon('tabler-edit')
                    ->form([
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\Placeholder::make('player_name')
                                    ->content(fn($record) => $record->player->name)
                                    ->label('Player')
                                    ->translateLabel(),

                                Forms\Components\Placeholder::make('club_name')
                                    ->content(fn($record) => $record->club->name)
                                    ->label('Player')
                                    ->translateLabel(),

                                Forms\Components\Placeholder::make('state')
                                    ->content(fn($record) => $record->state->translate())
                                    ->label('Player')
                                    ->translateLabel(),

                                Forms\Components\Select::make('state')
                                    ->label('State')
                                    ->translateLabel()
                                    ->options(RequestStateEnum::getTranslations())
                                    ->required()
                                    ->columnSpan('full'),
                            ])->columns(3)
                    ])
                    ->action(function (Request $request, $data) {
                        $request->state = $data['state'];
                        $request->save();

                        if($request->state == RequestStateEnum::Approved) {
                            $notification = new RequestApproved($request);

                            Club::where('id', $request->club_id)->first()->users->each(function ($user) use ($notification) {
                                $user->notify(
                                    $notification
                                );
                            });
                        } elseif ($request->state == RequestStateEnum::Rejected) {
                            $notification = new RequestRejected($request);

                            Club::where('id', $request->club_id)->first()->users->each(function ($user) use ($notification) {
                                $user->notify(
                                    $notification
                                );
                            });
                        }
                    })
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

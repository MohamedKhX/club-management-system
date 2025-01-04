<?php

namespace App\Filament\SportFederation\Resources;

use App\Enums\PlayerStateEnum;
use App\Enums\RequestStatus;
use App\Filament\SportFederation\Resources\PlayerResource\Pages;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers;
use App\Models\Club;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayerResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'iconpark-sport';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label("Player Avatar")
                    ->collection('avatar')
                    ->translateLabel()
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),


                TextColumn::make('date_of_birth')
                    ->label(__('Date of Birth'))
                    ->sortable(),

                TextColumn::make('position')
                    ->label(__('Position'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nationality')
                    ->label(__('Nationality'))
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('club_id')
                    ->label(__('Club'))
                    ->options(
                        Club::pluck('name', 'id')->toArray()
                    ),
                ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
               /* Tables\Actions\Action::make('show_contract')
                    ->label('Show Contract')
                    ->translateLabel()
                    ->color(Color::Green)
                    ->icon('iconpark-eyes')
                    ->url(fn (Player $player) => $player->getFirstMediaUrl('contract'), true),*/

           /*     Tables\Actions\Action::make('change_state')
                    ->label('Change State')
                    ->translateLabel()
                    ->color(Color::Amber)
                    ->icon('iconpark-circlethree')
                    ->form([
                        Select::make('state')
                            ->options([
                                PlayerStateEnum::Active->value => PlayerStateEnum::Active->translate(),
                                PlayerStateEnum::Inactive->value => PlayerStateEnum::Inactive->translate(),
                            ])
                            ->translateLabel()
                            ->required()
                            ->native(false),
                    ])
                    ->action(function (array $data, Player $player): void {
                        $player->state = $data['state'];
                        $player->save();
                    }),*/
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()
                    ->label("Info")
                    ->translateLabel()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                       DatePicker::make('date_of_birth')
                            ->label('Date Of Birth')
                            ->translateLabel()
                            ->required(),

                        TextInput::make('position')
                            ->label('Position')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->nullable(),

                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->translateLabel()
                            ->minLength(3)
                            ->maxLength(100)
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label('Player Avatar')
                            ->translateLabel()
                            ->image(),

                        Forms\Components\Hidden::make('sport_federation_id')
                            ->default(Filament::auth()->user()->sport_federation_id),
                    ])
                ->columns(1)
            ])->columns(1);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContractsRelationManager::make()
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('sport_federation_id', Filament::auth()->user()->sport_federation_id);
    }
}

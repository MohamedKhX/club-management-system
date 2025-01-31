<?php

namespace App\Filament\Club\Resources;

use App\Enums\PlayerStateEnum;
use App\Filament\Club\Resources\PlayerResource\Pages;
use App\Filament\SportFederation\Resources\PlayerResource\RelationManagers\ContractsRelationManager;
use App\Models\Player;
use App\Traits\HasTranslatedLabels;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
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

class PlayerResource extends Resource
{

    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'iconpark-sport';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->label("Player Avatar")
                    ->translateLabel()
                    ->collection('avatar')
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('state')
                    ->label(__('State'))
                    ->sortable()
                    ->badge()
                    ->color(fn (Model $record) => $record->state === PlayerStateEnum::Active ? Color::Green : Color::Red)
                    ->formatStateUsing(fn($state) => $state->translate()),

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
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }




















    use HasTranslatedLabels;

    public static function getFormSchema($outside = false): array
    {
        $spatieMediaArray = [
            SpatieMediaLibraryFileUpload::make('avatar')
                ->collection('avatar')
                ->label('Player Avatar')
                ->translateLabel()
                ->image(),

            SpatieMediaLibraryFileUpload::make('birth_certificate')
                ->collection('birth_certificate')
                ->label('Birth Certificate')
                ->translateLabel()
                ->image(),

            SpatieMediaLibraryFileUpload::make('passport')
                ->collection('passport')
                ->label('Passport')
                ->translateLabel()
                ->image(),
        ];

        $fileUploadArray = [
            Forms\Components\FileUpload::make('avatar')
                ->label('Player Avatar')
                ->translateLabel()
                ->image()
                ->disk('public')
                ->directory('attachments')
                ->preserveFilenames(),

            Forms\Components\FileUpload::make('birth_certificate')
                ->label('Birth Certificate')
                ->translateLabel()
                ->image()
                ->disk('public')
                ->directory('attachments')
                ->preserveFilenames(),

            Forms\Components\FileUpload::make('passport')
                ->label('Passport')
                ->translateLabel()
                ->image()
                ->disk('public')
                ->directory('attachments')
                ->preserveFilenames(),
        ];

        $whoWin = $outside ? $fileUploadArray : $spatieMediaArray;

        return [
            Fieldset::make()
                ->label("Info")
                ->translateLabel()
                ->schema([
                    TextInput::make('first_name')
                        ->label('First Name')
                        ->translateLabel()
                        ->minLength(3)
                        ->maxLength(100)
                        ->required(),

                    TextInput::make('middle_name')
                        ->label('Middle Name')
                        ->translateLabel()
                        ->minLength(3)
                        ->maxLength(100)
                        ->required(),


                    TextInput::make('grandfather_name')
                        ->label('Grandfather Name')
                        ->translateLabel()
                        ->minLength(3)
                        ->maxLength(100)
                        ->required(),

                    TextInput::make('last_name')
                        ->label('Last Name')
                        ->translateLabel()
                        ->minLength(3)
                        ->maxLength(100)
                        ->required(),

                    TextInput::make('national_number')
                        ->label('National Number')
                        ->translateLabel()
                        ->numeric()
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

                    TextInput::make('tunic_number')
                        ->label('Tunic Number')
                        ->translateLabel()
                        ->numeric()
                        ->maxLength(100)
                        ->required(),

                    TextInput::make('nationality')
                        ->label('Nationality')
                        ->translateLabel()
                        ->minLength(3)
                        ->maxLength(100)
                        ->required(),

                    ... $whoWin,

                    Forms\Components\Checkbox::make('accept_terms')
                        ->label('Accept Terms')
                        ->translateLabel()
                        ->required(),

                    Forms\Components\Placeholder::make('')
                        ->content('يقعر اللاعب بعدم ارتباطه أو التزامه مع أي نادي آخر لا إداريا ولا ماليا'),
                    Forms\Components\Placeholder::make('')
                        ->content('يتعهدا النادي واللاعب بإحترام العلاقة التعاقدية والالتزام بتنفيدها'),
                    Forms\Components\Placeholder::make('')
                        ->content('يتعهدا اللاعب والنادي باحترام اللوائح (المحلية والدولية) المنظمة للمسابقة الرياضية'),
                    Forms\Components\Placeholder::make('')
                        ->content('يتهعدا النادي واللاعب بتنفيذ كل القرارات التي تصدر عن مجلس إدارة الاتحاد الليبي لكرة القدم ولجانه العاملة'),


                    Forms\Components\Hidden::make('sport_federation_id')
                        ->default(Filament::auth()->user()->sport_federation_id),
                ])
                ->columns(1)
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getFormSchema()
            )->columns(1);
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            ContractsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit'   => Pages\EditPlayer::route('/{record}/edit'),
            'view'   => Pages\ViewPlayer::route('/{record}'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $clubId = auth()->user()->club_id;

        return parent::getEloquentQuery()
            ->whereHas('contracts', function ($query) use ($clubId) {
                $query->where('club_id', $clubId);
            });
    }

}

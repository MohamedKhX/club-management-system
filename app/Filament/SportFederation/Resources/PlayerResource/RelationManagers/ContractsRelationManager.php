<?php

namespace App\Filament\SportFederation\Resources\PlayerResource\RelationManagers;

use App\Models\Club;
use App\Models\Contract;
use App\Models\Player;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractsRelationManager extends RelationManager
{
    protected static string $relationship = 'contracts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([
                        Select::make('club_id')
                            ->label('Club')
                            ->translateLabel()
                            ->options(Club::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->required(),

                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->translateLabel()
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->translateLabel()
                            ->required(),

                        DatePicker::make('signed_date')
                            ->label('Signed Date')
                            ->translateLabel()
                            ->nullable(),

                        TextInput::make('amount')
                            ->label('Amount')
                            ->translateLabel()
                            ->numeric()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('Contract')
                            ->collection('contract')
                            ->label('Contract')
                            ->translateLabel(),

                        Forms\Components\Hidden::make('sport_federation_id')
                            ->default(Filament::auth()->user()->sport_federation_id),

                        Forms\Components\Hidden::make('club_id')
                            ->default($this->getOwnerRecord()->id),
                    ])->columns(1)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('state')
            ->columns([
                Tables\Columns\TextColumn::make('club.name')
                    ->label('Club')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('signed_date')
                    ->label('Signed Date')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->translateLabel()
                    ->badge()
                    ->color('success')
                    ->suffix(' د.ل'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Tables\Actions\Action::make('show_contract')
                    ->label('Show Contract')
                    ->translateLabel()
                    ->color(Color::Green)
                    ->icon('iconpark-eyes')
                    ->url(fn (Contract $contract) => $contract->getFirstMediaUrl('contract'), true)
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Contracts');
    }

    public static function getRecordLabel(): string
    {
        return __('Contract');
    }

    public static function getModelLabel(): ?string
    {
        return __('Contract');
    }

    public static function getPluralModelLabel(): ?string
    {
        return __('Contracts');
    }
}

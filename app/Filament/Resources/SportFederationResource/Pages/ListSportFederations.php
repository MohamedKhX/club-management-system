<?php

namespace App\Filament\Resources\SportFederationResource\Pages;

use App\Filament\Resources\SportFederationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSportFederations extends ListRecords
{
    protected static string $resource = SportFederationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

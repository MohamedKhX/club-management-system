<?php

namespace App\Filament\Club\Resources\AllPlayerResource\Pages;

use App\Filament\Club\Resources\AllPlayerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAllPlayers extends ListRecords
{
    protected static string $resource = AllPlayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

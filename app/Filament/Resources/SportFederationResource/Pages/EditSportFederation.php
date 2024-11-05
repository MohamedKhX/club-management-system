<?php

namespace App\Filament\Resources\SportFederationResource\Pages;

use App\Filament\Resources\SportFederationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSportFederation extends EditRecord
{
    protected static string $resource = SportFederationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

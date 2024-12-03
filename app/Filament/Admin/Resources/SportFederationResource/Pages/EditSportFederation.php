<?php

namespace App\Filament\Admin\Resources\SportFederationResource\Pages;

use App\Filament\Admin\Resources\SportFederationResource;
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
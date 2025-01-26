<?php

namespace App\Filament\Club\Resources\AllPlayerResource\Pages;

use App\Filament\Club\Resources\AllPlayerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAllPlayer extends EditRecord
{
    protected static string $resource = AllPlayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

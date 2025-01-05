<?php

namespace App\Filament\Club\Resources\RequestResource\Pages;

use App\Filament\Club\Resources\RequestResource;
use App\Models\SportFederation;
use App\Notifications\NewReport;
use App\Notifications\NewRequest;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRequest extends CreateRecord
{
    protected static string $resource = RequestResource::class;

    public function afterCreate()
    {
        $record = $this->getRecord();

        $notification = new NewRequest($record);

        SportFederation::where('id', $record->sport_federation_id)->first()->users->each(function ($user) use ($notification) {
            $user->notify(
                $notification
            );
        });
    }
}

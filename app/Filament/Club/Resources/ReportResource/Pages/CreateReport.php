<?php

namespace App\Filament\Club\Resources\ReportResource\Pages;

use App\Filament\Club\Resources\ReportResource;
use App\Notifications\NewReport;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    public function afterCreate()
    {
        dd('sdf');
        $notification = new NewReport($this->record);


        //we need to get the sportFederation user
        $sportFederation = $this->record->sportFederation;
        $users = $sportFederation->users;

        foreach ($users as $user) {
            $user->notify($notification);
        }
    }
}

<?php

namespace App\Filament\Club\Resources\ReportResource\Pages;

use App\Filament\Club\Resources\ReportResource;
use App\Models\SportFederation;
use App\Notifications\NewReport;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function ($record) {
                    $notification = new NewReport($record);

                    SportFederation::where('id', $record->sport_federation_id)->first()->users->each(function ($user) use ($notification) {
                        $user->notify(
                           $notification
                        );
                    });
                }),
        ];
    }
}

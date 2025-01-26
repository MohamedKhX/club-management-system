<?php

namespace App\Filament\Club\Resources\RequestResource\Pages;

use App\Filament\Club\Resources\RequestResource;
use App\Models\Player;
use App\Models\SportFederation;
use App\Notifications\NewReport;
use App\Notifications\NewRequest;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CreateRequest extends CreateRecord
{
    protected static string $resource = RequestResource::class;

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['player']['accept_terms']);
        $data['player']['sport_federation_id'] = $data['sport_federation_id'];
        $data['player']['is_active'] = false;
        $playerData = collect($data['player']);

// Create the player without media fields
        $player = Player::create(
            $playerData->except(['avatar', 'birth_certificate', 'passport'])->toArray()
        );


        if (isset($data['player']['avatar'])) {
            $filePath = $data['player']['avatar'];
            $absolutePath = Storage::disk('public')->path($filePath);
            if (file_exists($absolutePath)) {
                $player->addMedia($absolutePath)->toMediaCollection('avatar');
            }
        }

        if (isset($data['player']['birth_certificate'])) {
            $filePath = $data['player']['birth_certificate'];
            $absolutePath = Storage::disk('public')->path($filePath);
            if (file_exists($absolutePath)) {
                $player->addMedia($absolutePath)->toMediaCollection('birth_certificate');
            }
        }

        if (isset($data['player']['passport'])) {
            $filePath = $data['player']['passport'];
            $absolutePath = Storage::disk('public')->path($filePath);
            if (file_exists($absolutePath)) {
                $player->addMedia($absolutePath)->toMediaCollection('passport');
            }
        }

// Clean up and return data
        unset($data['player']);
        $data['player_id'] = $player->id;

        return $data;
    }

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

<?php

namespace App\Filament\Club\Resources\RequestResource\Pages;

use App\Filament\Club\Resources\RequestResource;
use App\Models\Player;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditRequest extends EditRecord
{
    protected static string $resource = RequestResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $player = Player::find($data['player_id']);
        $data['player'] = $player->toArray();
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if(! isset($data['player'])) {
            return $data;
        }

        unset($data['player']['accept_terms']);
        unset($data['player']['citizenship']);
        $data['player']['sport_federation_id'] = $data['sport_federation_id'];
        $data['player']['is_active'] = false;
        $playerData = collect($data['player']);

        $player = Player::find($data['player']['id']);
        // Create the player without media fields
        $player->update(
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

    protected function getRedirectUrl(): ?string
    {
        return ListRequests::getUrl(); // TODO: Change the autogenerated stub
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

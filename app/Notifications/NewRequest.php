<?php

namespace App\Notifications;

use App\Filament\SportFederation\Resources\RequestResource;
use App\Models\Request;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRequest extends Notification
{
    use Queueable;

    public Request $request;
    /**
     * Create a new notification instance.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(User $notifiable): array
    {
        return \Filament\Notifications\Notification::make()
            ->title('طلب جديد')
            ->info()
            ->body('طلب جديد من ' . $this->request->club->name)
            ->actions([
                  /*\Filament\Notifications\Actions\Action::make('view')
                      ->label('عرض')
                      ->url(RequestResource::getUrl('index')),*/
            ])
            ->getDatabaseMessage();
    }
}

<?php

namespace App\Notifications;

use App\Models\Request;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestRejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Request $request;
    public ?string $playerName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Request $request, $playerName = null)
    {
        $this->request = $request;
        $this->playerName = $playerName;
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

    public function toDatabase(User $notifiable): array
    {
        $message = '';

        if($this->playerName) {
            $message = 'تم رفض اللاعب ' . $this->playerName;
        } else {
            $message = $this->request->description;
        }
        return \Filament\Notifications\Notification::make()
            ->title('تم رفض الطلب')
            ->danger()
            ->body($message)
            ->getDatabaseMessage();
    }
}

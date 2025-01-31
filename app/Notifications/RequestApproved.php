<?php

namespace App\Notifications;

use App\Models\Request;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestApproved extends Notification
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

    public function toDatabase(User $notifiable): array
    {
        return \Filament\Notifications\Notification::make()
            ->title('تم قبل الطلب')
            ->success()
            ->body($this->request->description)
            ->getDatabaseMessage();
    }
}

<?php

namespace App\Notifications;

use App\Filament\SportFederation\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Filament\Actions\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReport extends Notification
{
    use Queueable;

    public Report $report;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(User $notifiable): array
    {
        return \Filament\Notifications\Notification::make()
            ->title('بلاغ جديد')
            ->info()
            ->body($this->report->title)
            ->actions([
              /*  \Filament\Notifications\Actions\Action::make('view')
                    ->label('عرض')
                    ->url(\App\Filament\Club\Resources\ReportResource::getUrl('index')),*/
            ])
            ->getDatabaseMessage();
    }
}

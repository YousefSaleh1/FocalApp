<?php

namespace App\Notifications;

use App\Models\BusinessOwner;
use App\Models\UserInfo;
use App\Models\CompanyJob;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddNewJob extends Notification
{
    use Queueable;
    private $job;
    /**
     * Create a new notification instance.
     */
    public function __construct(CompanyJob $job)
    {
        $this->job = $job;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        $business_owners_id = $this->job->business_owners_id;
        $business_owner = BusinessOwner::find($business_owners_id);
        $user_id = $business_owner->user_id;
        $user_info = UserInfo::where('user_id',$user_id)->get('full_name');

        return [
            'id'    => $this->job->id,
            'job_title' =>   $this->job->job_title  .'  '.' job has been added by',
            'business_owner' => $user_info,
        ];
    }
}

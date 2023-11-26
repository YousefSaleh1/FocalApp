<?php

namespace App\Notifications;

use App\Models\Blog;
use App\Models\UserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddNewBlog extends Notification
{
    use Queueable;
    private $blog;

    /**
     * Create a new notification instance.
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;

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
        $user_id = $this->blog->user_id;
        $user = UserInfo::where('user_id', $user_id)->get('full_name');
        return [
            'id'    => $this->blog->id,
            'title' =>   $this->blog->title  .'  '.' blog has been added by',
            'user' => $user,
        ];
    }
}

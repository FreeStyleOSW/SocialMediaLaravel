<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommented extends Notification
{
    use Queueable;

    protected $post_id;
    protected $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id,$comment_id)
    {
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Użytkownik ' . Auth::user()->name . ' skomentował <a href="'. url('posts/' . $this->post_id . '/#comment_' . $this->comment_id . '">Twój Post</a>')
        ];
    }
}

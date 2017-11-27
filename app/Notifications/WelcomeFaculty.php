<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Model\WelcomeMailTemplate;

class WelcomeFaculty extends Notification
{
    use Queueable;
    public $template;
    public $link;
    public $faculty;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($template,$link,$faculty)
    {
        $this->template = $template;
        $this->link= $link;
        $this->faculty= $faculty;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $welcome = WelcomeMailTemplate::first();
        return (new MailMessage)
                    ->subject($this->template->subject)
                    ->line($this->template->body)  
                    ->action('Activaion', $this->link)
                    ->markdown('template/preview.welcome-mail',['welcome'=>$welcome,'link'=>$this->link,'username'=>$this->faculty->staff_id]);
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
            //
        ];
    }
}

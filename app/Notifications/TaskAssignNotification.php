<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignNotification extends Notification
{
    use Queueable;
    private $taskData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($taskData)
    {
        $this->taskData = $taskData;
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
        return (new MailMessage)
            ->line($this->taskData['name'])
            //->line($this->taskData['email'])
            ->line($this->taskData['body'])
            //->action($this->taskData['text'], $this->taskData['url'])
            ->line($this->taskData['thanks']);

                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
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
            'task_id' => $this->taskData['task_id']
        ];
    }
}

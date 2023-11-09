<?php

namespace App\Notifications;

use App\Mail\PropertyContactMail;
use App\Models\Property;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class ContactRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Property $property, private array $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        /*
        // On peut ici vérifier si un utilisateur autorise les emails en notification
        if ($notifiable instanceof User && $notifiable->accept_email) {
            return ['mail','database'];
        }
        return ['database'];
        */
        // Utilise le canal mail et le canal database
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        sleep(2);
        /*
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
        */
        // On envoie un mailable à la place
        return (new PropertyContactMail($this->property, $this->data));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'property_id' => $this->property->id,
            'title' => $this->property->title,
            ...$this->data
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendUserValidateToken extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        //
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {

        $link_to_validate = route('front.validateToken', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Verifique seu Email - Cacique Fidelidade')
            ->greeting('Bem vindo!')
            ->salutation('Atenciosamente')
            ->line('Bem vindo! Para confirmar seu cadastro clique no link abaixo.')
            ->action('Validar cadastro', $link_to_validate)
            ->line('Obrigado por usar nossa aplicação!');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

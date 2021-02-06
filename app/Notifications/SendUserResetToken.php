<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendUserResetToken extends Notification
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
     * @param User $user
     * @param $token
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

        $link_to_validate = '';#route('front.showResetForm', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Redefinição de senha  - Fidelicash')
            ->greeting('Prezado(a) ' . $this->user->name)
            ->salutation('Atenciosamente')
            #->line('Nossa equipe recebeu uma solicitação de uma nova senha para a sua conta, acesse nosso link abaixo')
            ->line('Nossa equipe recebeu uma solicitação de uma nova senha para a sua conta, segue abaixo códido de verificação:')

            ->line($this->token)

            #->action('Redefinir senha', $link_to_validate)
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

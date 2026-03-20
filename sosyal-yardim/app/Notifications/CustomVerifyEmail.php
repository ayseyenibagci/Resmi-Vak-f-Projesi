<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('E-posta Adresinizi Doğrulayın')
            ->greeting('Merhaba!')
            ->line('Lütfen e-posta adresinizi doğrulamak için aşağıdaki butona tıklayın:')
            ->action('📩 E-posta Adresini Doğrula', $verifyUrl)
            ->line('Eğer bu hesabı siz oluşturmadıysanız, herhangi bir işlem yapmanız gerekmez.')
            ->salutation('Sevgilerimizle, ' . config('app.name'));
    }
}

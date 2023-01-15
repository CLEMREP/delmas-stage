<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Wizard any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Delmas-Stage - Activation de votre compte')
                ->line('Veuillez cliquer sur le bouton ci-dessous pour activer votre compte.')
                ->action('Activer mon compte', $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Delmas-Stage - Réinitialisation de votre mot de passe')
                ->line('Veuillez cliquer sur le bouton ci-dessous pour réinitialiser votre mot de passe.')
                ->action('Réinitialiser mon mot de passe', env('APP_URL') . $url)
                ->line('Le lien de réinitialisation du mot de passe expirera dans 60 minutes.')
                ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.');
        });
    }
}

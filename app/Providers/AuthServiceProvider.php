<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Permission;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

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
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        if(!App::runningInConsole()){
          foreach ($this->listPermissions() as $key => $permission) {
            Gate::define($permission->name, function ($user) use($permission) {
                return $user->hasRoles($permission->roles);
            });
          }
        }

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('Verify Email Address'))
                ->greeting(__('Hello!'))
                ->line(__('Thank you for creating an account. Please click the button below to verify your email address.'))
                ->action(__('Verify Email Address'), $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(__('Reset Password Notification'))
                ->line(__('You are receiving this email because we received a password reset request for your account.'))
                ->action(__('Reset Password'), $url)
                ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line(__('If you did not request a password reset, no further action is required.'));
        });

    }

    // listagem de permissões com os dados dos perfis (roles)
    private function listPermissions()
    {
        return Permission::with('roles')->get();
    }   
}

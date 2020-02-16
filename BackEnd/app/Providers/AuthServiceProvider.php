<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::tokensCan([
            'laporan' => 'can generate laporan',
            'upload_laporan' => 'can upload laporan',
            'user' => 'can manage user',
            'view' => 'can view',
            'edit' => 'can edit',
            'update' => 'can update',
            'delete' => 'can delete',
            'delete pengujian' => 'can delete pengujian',
        ]);
        Passport::routes();
    }
}

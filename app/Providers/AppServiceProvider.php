<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('create-job',function(Company $company, Job $job){
            return $company->hasRole('company');
        });

        Gate::define('update-job',function(Company $company, Job $job){
            return $company->id===$job->company_id;
        });


    }
}

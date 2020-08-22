<?php

namespace GrantHolle\PowerSchool\Schools;

use GrantHolle\PowerSchool\Schools\Commands\SyncSchools;
use Illuminate\Support\ServiceProvider;

class PowerSchoolSchoolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migration.php' => database_path('migrations/2014_10_11_000000_create_schools_table.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncSchools::class,
            ]);
        }
    }
}

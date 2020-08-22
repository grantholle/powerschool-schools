<?php

namespace GrantHolle\PowerSchool\Schools\Commands;

use GrantHolle\PowerSchool\Schools\Models\School;
use Illuminate\Console\Command;

class SyncSchools extends Command
{
    protected $signature = 'powerschool:schools {school_number?}';

    protected $description = 'Syncs all schools or a single school from PowerSchool';

    public function handle()
    {
        (School::getFromPowerSchool())->each(function ($school) {
            if (
                $this->argument('school_number') &&
                (int) $this->argument('school_number') !== $school->school_number
            ) {
                return;
            }

            $this->info("Syncing {$school->name}...");

            School::updateOrCreate(['id' => $school->id], [
                'school_number' => $school->school_number,
                'name' => $school->name,
                'high_grade' => $school->high_grade,
                'low_grade' => $school->low_grade,
            ]);

            $this->info('Done!');
        });
    }
}

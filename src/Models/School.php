<?php


namespace GrantHolle\PowerSchool\Schools\Models;

use GrantHolle\PowerSchool\Api\Facades\PowerSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class School extends Model
{
    protected $guarded = [];

    public static function getFromPowerSchool(array $ids = []): Collection
    {
        $psSchools = PowerSchool::endpoint('/ws/v1/district/school')
            ->excludeProjection()
            ->get();

        return collect($psSchools->schools->school);
    }

    public function syncFromPowerSchool(): School
    {
        $school = static::getFromPowerSchool()->first(function ($school) {
            return $this->id === $school->id;
        });

        $this->update([
            'name' => $school->name,
            'school_number' => $school->school_number,
            'high_grade' => $school->high_grade,
            'low_grade' => $school->low_grade,
        ]);

        return $this;
    }
}

<?php
namespace App\Business;

use App\Models\TimeBlock;
use App\Models\WorkingHour;
use Illuminate\Support\Collection;

class CreateWorkingHourBusiness
{
    public static function canCreate(WorkingHour $working_hour)
    {
        $working_hour->timeBlocks->each(function(TimeBlock $timeBlock) use ($working_hour) {
            if ($timeBlock)
           $week_day_integers = collect($timeBlock->week_days)->reject(function($day) {
              return ($day->value != true);
           })->map(function($day) {
               return $day->id;
           });
           ($week_day_integers)->each(function ($week_day) use ($week_day_integers, $working_hour, $timeBlock) {
               $start_hour = $timeBlock->start_hour;
               $end_hour   = $timeBlock->end_hour;
               $time_blocks_in_same_day = $working_hour->timeBlocks->filter(function($time_block) use ($week_day_integers) {
                   return self::verifyTimeBlocksMerge($week_day_integers, $time_block);
               });
               dd($time_blocks_in_same_day->toArray());
           });
        });
    }

    private static function verifyTimeBlocksMerge(Collection $week_day_integers, TimeBlock $time_block): bool
    {
        $exists = false;
        collect($time_block->week_days)->each(function($day) use ($week_day_integers, &$exists) {
            $week_day_integers->each(function($week_day_from_creating) use ($day, &$exists) {
                if (($day->value === true) && ($day->id != $week_day_from_creating)) {
                    $exists = true;
                }
            });
        });
        return $exists;
    }
}

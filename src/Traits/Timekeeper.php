<?php
namespace Midnite81\TimeKeeper\Traits;

trait TimeKeeper
{

    /**
     * Checks for overlaps
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    function scopeNoOverlap($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time') {

        $query->where(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
            // where the start date starts at the same time or after the original entry
            // and where the end date finishes after the original entry
            // (diagram: block 1)
            $q->where($startDateColumn, '<=', $startDate)
              ->where($endDateColumn, '>', $startDate);
        })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                // where the start time starts at the same time or after the original
                // and the end time finishes before or equal to the end of the original
                // (diagram 2, 5)
                $q->where($startDateColumn, '>=', $startDate)
                  ->where($endDateColumn, '<=', $endDate);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                // where the start time starts before the original and
                // the end time finishes before or on the original end date
                // diagram (3)
                $q->where($startDateColumn, '>', $startDate)
                  ->where($endDateColumn, '>', $startDate)
                  ->where($endDateColumn, '>=', $endDate)
                  ->where($startDateColumn, '<', $endDate);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                // where the start time starts before the original and
                // the end time finishes after the original end date
                // diagram (4)
                $q->where($startDateColumn, '<', $startDate)
                  ->where($endDateColumn, '>', $endDate);
            });
    }

}
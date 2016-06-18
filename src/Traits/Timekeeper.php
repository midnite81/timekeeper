<?php
namespace Midnite81\TimeKeeper\Traits;

use Carbon\Carbon;

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
            $q->where($startDateColumn, '<=', $startDate)
              ->where($endDateColumn, '>', $startDate);
        })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $q->where($startDateColumn, '>=', $startDate)
                  ->where($endDateColumn, '<=', $endDate);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $q->where($startDateColumn, '>', $startDate)
                  ->where($endDateColumn, '>', $startDate)
                  ->where($endDateColumn, '>=', $endDate)
                  ->where($startDateColumn, '<', $endDate);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $q->where($startDateColumn, '<', $startDate)
                  ->where($endDateColumn, '>', $endDate);
            });
    }
    
    public function scopeAfter($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, '<', $startDate);
    }

    public function scopeStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, $startDate);
    }
    
    public function scopeStartInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, '>', $startDate);
    }

    public function scopeInsideStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, '<', $endDate);
    }

    public function scopeEnclosingStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, '>', $endDate);
    }


    public function scopeEnclosing($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, '>', $endDate);
    }

    public function scopeEnclosingEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, $endDate);
    }

    public function scopeExactMatch($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, $endDate);
    }

    public function scopeInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, '>', $endDate);
    }

    public function scopeInsideEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, $endDate);
    }

    public function scopeEndInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $endDate);
    }

    public function scopeEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $endDate);
    }

    public function scopeBefore($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '>', $endDate);
    }

    public function scopeIsSamePeriod($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $this->scopeExactMatch($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time');
    }

    public function scopeHasInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $this->scopeEnclosingStartTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeEnclosing($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeEndTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeExactMatch($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
    }

    public function scopeOverlapsWith($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $this->scopeHasInside($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeStartInside($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeInsideStartTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeInside($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeInsideEndTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeEndInside($query, $startDate, $endDate, $startDateColumn, $endDateColumn);

    }

    public function scopeIntersectsWith($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $this->scopeOverlapsWith($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeStartTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
        $this->scopeEndTouching($query, $startDate, $endDate, $startDateColumn, $endDateColumn);
    }

}
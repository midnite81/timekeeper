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
    function scopeNoOverlap($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {

        $query->where(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
            $q->where($startDateColumn, '<=', $startDate)
              ->where($endDateColumn, '>', $startDate);
        })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $q->where($startDateColumn, '>=', $startDate)
                    ->where($endDateColumn, '<=', $endDate);
              })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $q->where($startDateColumn, '>', $startDate)
                    ->where($endDateColumn, '>', $startDate)
                    ->where($endDateColumn, '>=', $endDate)
                    ->where($startDateColumn, '<', $endDate);
              })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
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
        $query->where($endDateColumn, '>', $startDate)
              ->where($startDateColumn, '<', $startDate);
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
        $query->where($startDateColumn, '<', $endDate)
              ->where($endDateColumn, '>', $endDate);
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
        $query->where(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
            $this->scopeEnclosingStartTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
        })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $this->scopeEnclosing($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
              })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $this->scopeEndTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
              })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $this->scopeExactMatch($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
              });
    }

    public function scopeOverlapsWith($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
            $this->scopeHasInside($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
        })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $this->scopeStartInside($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $this->scopeInsideStartTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $this->scopeInside($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $this->scopeInsideEndTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
            })
            ->orWhere(function($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                $this->scopeEndInside($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
            });

    }

    public function scopeIntersectsWith($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
            $this->scopeOverlapsWith($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
        })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $this->scopeStartTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
              })
              ->orWhere(function ($q) use ($startDate, $endDate, $startDateColumn, $endDateColumn) {
                  $this->scopeEndTouching($q, $startDate, $endDate, $startDateColumn, $endDateColumn);
              });
    }

}
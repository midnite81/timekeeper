<?php
namespace Midnite81\TimeKeeper\Traits;


trait TimeKeeper
{

    /**
     * After Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeAfter($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, '<', $startDate);
    }

    /**
     * Start Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, $startDate);
    }

    /**
     * Start Inside Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeStartInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($endDateColumn, '>', $startDate)
              ->where($startDateColumn, '<', $startDate);
    }

    /**
     * Inside Start Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeInsideStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, '<', $endDate);
    }

    /**
     * Enclosing Start Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeEnclosingStartTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, '>', $endDate);
    }


    /**
     * Enclosing Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeEnclosing($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, '>', $endDate);
    }

    /**
     * Enclosing End Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeEnclosingEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, $endDate);
    }

    /**
     * Exact Match Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeExactMatch($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $startDate)
              ->where($endDateColumn, $endDate);
    }

    /**
     * Inside Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, '>', $endDate);
    }

    /**
     * Inside End Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeInsideEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $startDate)
              ->where($endDateColumn, $endDate);
    }

    /**
     * End Inside Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeEndInside($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '<', $endDate)
              ->where($endDateColumn, '>', $endDate);
    }

    /**
     * End Touching Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeEndTouching($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, $endDate);
    }

    /**
     * Before Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeBefore($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {
        $query->where($startDateColumn, '>', $endDate);
    }

    /**
     * Is Same Period Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
    public function scopeIsSamePeriod($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time')
    {

        $this->scopeExactMatch($query, $startDate, $endDate, $startDateColumn = 'start_time', $endDateColumn = 'end_time');
    }

    /**
     * Has Inside Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
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

    /**
     * Overlaps with Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
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

    /**
     * Intersects With Scope
     *
     * @param $query
     * @param $startDate
     * @param $endDate
     * @param string $startDateColumn
     * @param string $endDateColumn
     */
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
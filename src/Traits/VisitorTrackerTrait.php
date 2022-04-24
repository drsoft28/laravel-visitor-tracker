<?php

namespace Drsoft\VisitorTracker\Traits;

trait VisitorTrackerTrait{
    public function scopeVisitorsWithinSeconds($query, $seconds)
    {
        
        return $query->where('created_at', '>=', now()->subSeconds($seconds));
    }

    public function scopeVisitorsWithinMinutes($query, $minutes)
    {
        return $query->visitorsWithinSeconds($minutes * 60);
    }
    public function scopeVisitorsWithinHours($query, $hours)
    {
        return $query->visitorsWithinSeconds($hours * 60 * 60);
    }
}
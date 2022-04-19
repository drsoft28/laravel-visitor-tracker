<?php

namespace Drsoft\VisitorTracker\Models;

//use App\Models\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class VisitorTracker extends Model
{
    //use HasFactory;

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

<?php

namespace Drsoft28\VisitorTracker\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Drsoft28\VisitorTracker\Traits\VisitorTrackerTrait;
class VisitorTracker extends Model
{
    use VisitorTrackerTrait;
	protected function casts(): array
    {
        return [
                'route_params' => 'array',
            ];
    }
    
}

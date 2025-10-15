<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class AppEvent extends Model
{

    

    use HasFactory;
    //
    protected $table = 'app_events';

    protected static function validateEvent($event)
    {
        // 1️⃣ Ensure end is after start
        if ($event->end_at <= $event->start_at) {
            throw ValidationException::withMessages([
                'end_at' => 'End date must be after start date.',
            ]);
        }

        // 2️⃣ Ensure location is not double-booked
        $overlapping = self::where('location_id', $event->location_id)
            ->where(function ($query) use ($event) {
                $query->whereBetween('start_at', [$event->start_at, $event->end_at])
                      ->orWhereBetween('end_at', [$event->start_at, $event->end_at])
                      ->orWhere(function ($q) use ($event) {
                          $q->where('start_at', '<=', $event->start_at)
                            ->where('end_at', '>=', $event->end_at);
                      });
            });

        // Exclude self when updating
        if ($event->exists) {
            $overlapping->where('id', '!=', $event->id);
        }

        if ($overlapping->exists()) {
            throw ValidationException::withMessages([
                'location_id' => 'This location is already booked during the specified time.',
            ]);
        }
    }

    protected static function booted()
    {
         // Runs on creating
        static::creating(function ($event) {
            self::validateEvent($event);
        });

        // Runs on updating
        static::updating(function ($event) {
            self::validateEvent($event);
        });


    }

    protected $fillable = [
        'title',
        'start_at',
        'end_at',
        'location_id'
    ];

    public function location() : BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function organizers() : BelongsToMany
    {
        return $this->belongsToMany(Organizer::class);
    }
}

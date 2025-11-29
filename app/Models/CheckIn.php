<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{


protected static function validateCheckIn($checkIn)
     {



         $query = self::where('app_event_id',$checkIn->attendee()->ticket()->id())->where('ticket_type_id',$ticket->ticket_type_id);
      

       if ($ticket->exists) {
        $query->where('id', '!=', $ticket->id);
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


    //
    protected $fillable = ['app_event_id','attendee_id','scanned_at'];

    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function attendee() : BelongsTo
    {
        return $this->belongsTo(Attendee::class);
    }

}

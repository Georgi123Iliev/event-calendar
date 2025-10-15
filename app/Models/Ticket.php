<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = ['event_id','type_id','price','quota'];


     protected static function validateTicket($ticket)
     {
       $query = self::where('event_id',$ticket->event_id)->where('type_id',$ticket->type_id);
      

       if ($ticket->exists) {
        $query->where('id', '!=', $ticket->id);
        }

      if($query->exists())
      {
        throw ValidationException::withMessages([
                'event_id' => ['A ticket for this event already exists.'],
                'type_id'  => ['This ticket type is already taken for the event.']
            ]);
      }

     }

    protected static function booted()
    {
         // Runs on creating
        static::creating(function ($ticket) {
            self::validateTicket($ticket);
        });

        // Runs on updating
        static::updating(function ($ticket) {
            self::validateTicket($ticket);
        });


    }


    public function event() : BelongsTo
    {
        return $this->belongsTo(AppEvent::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }
}

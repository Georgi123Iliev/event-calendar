<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = ['event_id','ticket_type_id','price','quota'];


     protected static function validateTicket($ticket)
     {
       $query = self::where('app_event_id',$ticket->app_event_id)->where('ticket_type_id',$ticket->ticket_type_id);
      

       if ($ticket->exists) {
        $query->where('id', '!=', $ticket->id);
        }

      if($query->exists())
      {
        throw ValidationException::withMessages([
                'event_id' => ['A ticket for this event already exists.'],
                'ticket_type_id'  => ['This ticket type is already taken for the event.']
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

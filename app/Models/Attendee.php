<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;
    //

    protected $fillable = ['email','name','ticket_id'];



 protected static function validateAttendee($attendee,$maxTicketCount = 5)
     {



        $existingTickets = self::where('email', $attendee->email)
            ->whereHas('ticket', fn($q) => 
                $q->where('app_event_id', $attendee->ticket->app_event_id)
            )
            ->when($attendee->exists, fn($q) => $q->whereKeyNot($attendee->id))
            ->count();


            if($existingTickets >= $maxTicketCount)
            {
                    throw ValidationException::withMessages([
                    'email' => ['Too many tickets belong to this email'],
                
                ]);
            }

     }

     protected static function decrementQuota($ticket)
     {
        if($ticket->quota == 0)
        {
            throw new \LogicException('Ticket quota exhausted.');
        }
        else
        {
           $ticket->decrement('quota');
        }
     }


    protected static function booted()
    {
         // Runs on creating
        static::creating(function ($attendee) {
            self::validateAttendee($attendee);
            self::decrementQuota($attendee->ticket);
        });

        // Runs on updating
        static::updating(function ($attendee) {
            self::validateAttendee($attendee);
            
           

            if ($attendee->isDirty('ticket_id')) {
                // Get old and new event IDs
                $oldTicketId = $attendee->getOriginal('ticket_id');
                $newTicketId = $attendee->ticket_id;

                // Increment old event quota
                \App\Models\Ticket::where('id', $oldTicketId)->increment('quota');

                self::decrementQuota($attendee->ticket);
            
            }

            
            
        });


    }








    public function ticket() : BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}

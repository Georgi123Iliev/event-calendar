<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Organizer extends Model
{
  use HasFactory;

      protected $fillable = [
    'name',
    'email',
    'user_id'
    ];

   public function appEvents() : BelongsToMany
    {
        return $this->belongsToMany(AppEvent::class);
    }

public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    
}

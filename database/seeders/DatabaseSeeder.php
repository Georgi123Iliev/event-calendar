<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TicketType;
use App\Models\Ticket;
use App\Models\Organizer;
use App\Models\AppEvent;
use App\Models\Attendee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        AppEvent::factory()->create();

        if(TicketType::count() == 0)
        {
            TicketType::factory()->create(['type' => "Regular"]);
            TicketType::factory()->create(['type' => "VIP"]);
            TicketType::factory()->create(['type' => "Only Fans"]);
        }
        if(Organizer::count() != 0 )
        {
            Organizer::truncate();
        }

        if(Organizer::count() == 0)
        {
           Organizer::factory()->create(['name' => "Ivan",'email'=>"abc@abv.bg"]); 
           
           Organizer::first()->appEvents()->attach(AppEvent::first()->id);

        }

        if(Ticket::count() == 0)
        {
            Ticket::factory()->create(
                [
                    'app_event_id' => AppEvent::first()->id,
                    'quota' => 100,
                    'price' => 50,
                    'ticket_type_id' => TicketType::where('type',"Only Fans")->first()->id]);
        }


        if(Attendee::count() == 0)
        {
            Attendee::factory()->create([
                'ticket_id' => Ticket::first()->id
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TicketType;
use App\Models\Organizer;
use App\Models\AppEvent;
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

    }
}

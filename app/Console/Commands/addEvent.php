<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\AppEvent;

class addEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-app-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $AppEvent = AppEvent::factory()->create();

     
    }
}

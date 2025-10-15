<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class example extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:example';

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
      $query = User::query();

        if ($email = $this->option('email')) {
            $query->where('email', $email);
        }

        if ($id = $this->option('id')) {
            $query->where('id', $id);
        }

        $users = $query->get(['id', 'name', 'email', 'created_at']);

        if ($users->isEmpty()) {
            $this->info('No users found.');
            return 0;
        }

        $this->table(
            ['ID', 'Name', 'Email', 'Created At'],
            $users->toArray()
        );

        return 0;
        
    }
}

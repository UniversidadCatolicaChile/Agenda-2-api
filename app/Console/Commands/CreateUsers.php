<?php

namespace App\Console\Commands;

use App\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'command:create_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create users for use on API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $token = Str::random(80);
      $user = Customer::where('email', '=', 'agenda@uc.cl')->first();
      if(!$user){
        $user = Customer::create([
            'name' => 'SuperAdmin',
            'email' => 'agenda@uc.cl',
            'password' => Hash::make('Q16DZb*r'),
            'api_token' => hash('sha256', $token)
        ]);
      }
    }
}

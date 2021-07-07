<?php

namespace App\Console\Commands;

use App\Models\User;
use Auth;
use Illuminate\Console\Command;

class AdminGenerateUser extends Command
{
    protected $signature = 'admin:user';

    protected $description = 'Make admin super user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $login = 'arendach.taras@gmail.com';
        $password = 'qwerty';

        if (!User::where('email', $login)->count()) {
            User::create([
                'name'           => 'Admin',
                'email'          => $login,
                'password'       => Auth::hashMake($password),
                'remember_token' => '',
                'created_at'     => now(),
                'updated_at'     => now(),
                'phone'          => '096-445-68-51',
                'access_id'      => '-1',
                'locale'         => 'uk',
                'role'           => 'admin',
                'base_id'        => 1
            ]);
        }

        echo "Login    => $login \n";
        echo "Password => $password \n";
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{   
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'User1',
                'email' => 'user1@email.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@email.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'User3',
                'email' => 'user3@email.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'User4',
                'email' => 'user4@email.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'User5',
                'email' => 'user5@email.com',
                'password' => Hash::make('password123'),
            ]
        ];

        $this->user->insert($users);
    }
}

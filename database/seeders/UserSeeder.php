<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::truncate();

        $users = [
            [ 'name' => 'NetCoden Inc' ],
            [ 'name' => 'Nasiruddin Khan' ],
            // [ 'name' => '' ],
        ];

        foreach ($users as $key => $user) {
            $user['email'] = $key === 0 ? 'netcoden@gmail.com' : 'shawonk007@gmail.com';
            $user['password'] = Hash::make('12345678');
            $user['role'] = $key === 0 ? Role::ADMIN : Role::CUSTOMER;
            User::create($user);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\ClientFactory;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = 88888;
        //find a id that is not used
        while(User::find($id) != null) {
        	         $id = rand(10000, 99999);
        }

        ClientFactory::new()->count(1)->create([
            'id' => $id, 
        ]);
        User::factory()->create([
            'id' => $id,
            'name' => 'client',
            'email' => 'client@client.nl',
            'password' => bcrypt('client'),
            'role' => 'client',
            

        ]);

    }
}

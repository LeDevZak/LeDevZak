<?php
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::factory()->admin()->create([
            'name' => 'LeDevZak',
            'email' => 'zaka.choaibi@email.com',
            'password' => Hash::make('zaka@Dev20'), // Hash the password
        ]);

        // Create regular users
        User::factory(10)->create();

        // Create posts for the admin user
        $adminUser = User::where('email', 'zaka.choaibi@email.com')->first();
        Post::factory(10)->create([
            'user_id' => $adminUser->id
        ]);
    }
}



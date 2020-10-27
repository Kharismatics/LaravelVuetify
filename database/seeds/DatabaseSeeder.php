<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'api_token' => base64_encode(Str::random(40)),
            'created_at' => DB::raw('now()'),  
        ]);
        for ($i = 0; $i < 100; $i++) {
            DB::table('categories')->insert([
                'name' => "test_$i",
                'description' => "kharismatics_$i@gmail.com",
                'created_by' => 1,  
                'created_at' => DB::raw('now()'),  
            ]);
        }
    }
}

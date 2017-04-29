<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Schedule::class,50)->create();
        factory(App\Address::class,6)->create();
        factory(App\Favorite::class,30)->create();

    }
}

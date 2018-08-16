<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('students')->insert([
            ['name'=>'jeff','age'=>20],
            ['name'=>'blackrun','age'=>21],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\Setting::create([
        'blog_name'=> 'Muhammed Blog' ,
        'phone_number'=> '00 964 123 1234' ,
        'blog_email'=> 'muhammed.essa@codeforiraq.org' ,
        'address'=> 'IRAQ - Sulymaniyeh'  
       ]);
    }
}

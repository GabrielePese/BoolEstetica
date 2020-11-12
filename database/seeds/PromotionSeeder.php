<?php

use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            'name' => 'Sconto del 50%',
            'discount'=> '50'    
        ]);

        DB::table('promotions')->insert([
            'name' => 'Sconto del 80%',
            'discount'=> '80'
            
        ]);
    }
}

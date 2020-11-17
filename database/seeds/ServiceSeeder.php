<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Ceretta gamba',
            'description'=> 'Prova la tua cerettta alla GAMBA da 1ora',
            'duration' => '60',
            'price' => '20',
            'originalprice' => '20',
            'photo' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'video' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'promotion' => 0,
            'disabled' => 0,
            'delete' => 0
        ]);

        DB::table('services')->insert([
            'name' => 'Ceretta braccio',
            'description'=> 'Prova la tua cerettta alla BRACCIO da 1ora',
            'duration' => '60',
            'price' => '20',
            'originalprice' => '20',
            'photo' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'video' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'promotion' => 0,
            'disabled' => 0,
            'delete' => 0
        ]);

        DB::table('services')->insert([
            'name' => 'LASER',
            'description'=> 'Prova la tua cerettta alla LASE da 1ora',
            'duration' => '60',
            'price' => '100',
            'originalprice' => '100',
            'photo' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'video' => 'https://www.fashionsinner.com/wp-content/uploads/2016/08/gamba-depilata.jpg',
            'promotion' => 0,
            'disabled' => 0,
            'delete' => 0
        ]);

        DB::table('services')->insert([
            'name' => 'Massaggio',
            'description'=> 'Prova il nostro massaggio decontratturante',
            'duration' => '30',
            'price' => '50',
            'originalprice' => '50',
            'photo' => 'https://www.esteticaoxy.com/wp-content/uploads/2017/12/massaggio-relax.jpg',
            'video' => 'https://www.esteticaoxy.com/wp-content/uploads/2017/12/massaggio-relax.jpg',
            'promotion' => 0,
            'disabled' => 0,
            'delete' => 0
        ]);
    }
}

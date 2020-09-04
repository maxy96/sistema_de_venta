<?php

use Illuminate\Database\Seeder;
use App\Models\Medidas;

class MedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Medidas::create([
    		'medida' => 'kg',
    		'descripcion' => 'kilogramos'
    	]);    	
    	Medidas::create([
    		'medida' => 'g',
    		'descripcion' => 'gramos'
    	]);
    	Medidas::create([
    		'medida' => 'u',
    		'descripcion' => 'unidad'
    	]);
    }
}

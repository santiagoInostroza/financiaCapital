<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
       Property::create([
              'address' => 'Casa en el centro',
              'description' => 'Casa en el centro de la ciudad',
              'price' => '18000',
              'bedrooms' => '3',
              'bathrooms' => '2',
              'garage' => '1',
              'area' => '200m2',
              'user_id' => '1',
                'image' => 'https://cdn.pixabay.com/photo/2017/06/18/01/57/condo-2414328_960_720.jpg',
       ]);

       Property::create([
        
        'address' => 'Casa en el sur de la ciudad',
        'price' => '25000',
        'bedrooms' => '4',
        'bathrooms' => '3',
        'garage' => '1',
        'area' => '300m2',
        'user_id' => '2',
        'image' => 'https://cdn.pixabay.com/photo/2018/01/26/08/37/architecture-3108075_960_720.jpg',
       ]);

       Property::create([
        'address' => 'Casa en el norte',
        'description' => 'Casa en el norte de la ciudad',
        'price' => '12000',
        'bedrooms' => '3',
        'bathrooms' => '2',
        'garage' => '0',
        'area' => '100m2',
        'user_id' => '2',
        'image' => 'https://cdn.pixabay.com/photo/2016/08/05/17/26/new-1572716_960_720.jpg',
       ]);

       Property::create([
        'address' => 'Casa en el norte',
        'description' => 'Casa en el norte de la ciudad',
        'price' => '12000',
        'bedrooms' => '3',
        'bathrooms' => '2',
        'garage' => '0',
        'area' => '100m2',
        'user_id' => '2',
        'image' => 'https://cdn.pixabay.com/photo/2019/10/08/13/01/housing-4534993_960_720.jpg',
       ]);

       Property::create([
        'address' => 'Casa en el norte',
        'description' => 'Casa en el norte de la ciudad',
        'price' => '12000',
        'bedrooms' => '3',
        'bathrooms' => '2',
        'garage' => '0',
        'area' => '100m2',
        'user_id' => '2',
        'image' => 'https://cdn.pixabay.com/photo/2021/12/12/02/53/house-6864134_960_720.jpg',
       ]);

       Property::create([
        'address' => 'Casa en el norte',
        'description' => 'Casa en el norte de la ciudad',
        'price' => '12000',
        'bedrooms' => '3',
        'bathrooms' => '2',
        'garage' => '0',
        'area' => '100m2',
        'user_id' => '2',
        'image' => 'https://cdn.pixabay.com/photo/2017/03/27/09/59/house-2177865_960_720.jpg',
       ]);
    }
}

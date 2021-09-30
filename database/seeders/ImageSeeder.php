<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    //We create a seeder for the image with all the relevant data
    public function run()
    {
        $image = new Image();
        $image->user_id = '1';
        $image->description = 'Test Seed';
        $image->resolution = '200x200';
        $image->image = '1632957953.jpg';
        $image->save();
    }
}

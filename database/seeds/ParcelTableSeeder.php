<?php

use App\Parcel;
use Illuminate\Database\Seeder;

class ParcelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 200;
        factory(Parcel::class, $count)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Shoppinglist;
use App\Models\Shoppinglistdetail;
use Illuminate\Database\Seeder;

class ShoppinglistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoppinglist = Shoppinglist::create([
            'title' => 'Kebutuhan dapur',
            'date' => date('2021/03/06 13:00:00')
        ]);

        for ($i=1; $i < 5; $i++) { 
            Shoppinglistdetail::create([
                'shoppinglist_id' => $shoppinglist->id,
                'number' => $i,
                'itemname' => 'Ikan '.$i,
                'amount' => $i,
                'unit' => 'Ekor'
            ]);
        }
    }
}

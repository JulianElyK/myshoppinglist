<?php

namespace App\Http\Controllers;

use App\Models\Shoppinglist;
use App\Models\Shoppinglistdetail;
use Illuminate\Http\Request;

class ShoppinglistdetailsController extends Controller
{
    public function index(){
        return view('inputshoppinglist.index');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required'
        ]);

        $shoppinglist = new Shoppinglist;
        $shoppinglist->title = $request->title;
        $shoppinglist->date = $request->datetime;
        $shoppinglist->save();

        $shoppinglist_id = $shoppinglist->id;

        foreach ($request->itemnames as $key => $value) {
            $shoppinglistdetail = new Shoppinglistdetail;
            $shoppinglistdetail->shoppinglist_id = $shoppinglist_id;
            $shoppinglistdetail->number = $key + 1;
            $shoppinglistdetail->itemname = $request->itemnames[$key];
            $shoppinglistdetail->amount = $request->amounts[$key];
            $shoppinglistdetail->unit = $request->units[$key];
            $shoppinglistdetail->memo = $request->memos[$key];
            $shoppinglistdetail->save();
        }

        return redirect('/shoppinglists');
    }

}

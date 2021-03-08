<?php

namespace App\Http\Controllers;

use App\Models\Shoppinglist;
use App\Models\Shoppinglistdetail;
use Illuminate\Http\Request;

class ShoppinglistsController extends Controller
{
    public function index(){
        $shoppinglists = Shoppinglist::all();

        return view('shoppinglists.index', [
            'shoppinglists' => $shoppinglists
        ]);
    }

    public function details($shoppinglist_id){
        $shoppinglists = Shoppinglist::all();
        $shoppinglistdetails = Shoppinglistdetail::where('shoppinglist_id', $shoppinglist_id)->get();

        return view('shoppinglists.index', [
            'shoppinglists' => $shoppinglists,
            'shoppinglistdetails' => $shoppinglistdetails
        ]);
    }
    public function updateForm($shoppinglist_id){
        $shoppinglist = Shoppinglist::where('id', $shoppinglist_id)->first();
        $shoppinglistdetails = Shoppinglistdetail::where('shoppinglist_id', $shoppinglist_id)->get();
        
        return view('updateshoppinglist.index', compact('shoppinglist', 'shoppinglistdetails'));
    }

    public function updateList(Request $request){
        $shoppinglist_id = $request->shoppinglist_id;
        
        $shoppinglist = Shoppinglist::where('id', $request->shoppinglist_id)
        ->update([
            'title' => $request->title,
            'date' => $request->datetime
        ]);

        Shoppinglistdetail::where('shoppinglist_id', $shoppinglist_id)->delete();

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

        return redirect('/shoppinglists/'.$shoppinglist_id);
    }

    public function deleteList($shoppinglist_id){
        Shoppinglist::destroy($shoppinglist_id);
        Shoppinglistdetail::where('shoppinglist_id', $shoppinglist_id)->delete();

        return redirect('/shoppinglists');
    }
}

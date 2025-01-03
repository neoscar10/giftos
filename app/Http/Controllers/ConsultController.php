<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ConsultController extends Controller
{
    //

    public function book_consultation(){
        if (Auth::id()) {
            // for showing cart
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
            //end of side
        } else {
            $count = '';
        }

        return view('consult.book_consultation', compact('count'));
    }
}

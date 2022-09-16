<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function create($id, Request $request)
    {
        $user = User::where('slug', $id)->get();
        $data = Wish::create([
            'name'      => ucwords($request->name),
            'slug_id'   => $user[0]->id,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'message'   => $request->message,
            'status'    => 1
        ]);

        $user = User::where('id', $data['slug_id'])->first();
        if ($data) {
            return redirect()->route('front.data.wish', $user->slug)->with('success', 'Thank you for your kind wishes');
        }
    }
}

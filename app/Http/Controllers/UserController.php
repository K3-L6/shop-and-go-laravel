<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use App\User;
use App\City;

class UserController extends Controller
{
    public function updateAvatar(Request $request)
    {
    	$user = Auth::user();
     
        if($request->hasFile('avatar'))
        {
            $path = public_path() . '/images/avatars/' . $user->avatar;
            if(file_exists($path) and $user->avatar != "noavatar.jpg")
            {
                unlink($path);
            }

            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            Image::make($avatar)->resize(300, 300)->save( public_path('/images/avatars/' . $filename) );

            $user->avatar = $filename;
            $user->save();

        	return redirect()->back()->with('success', 'Successfully updated avatar');
        }else{
        	return redirect()->back()->with('error', 'No Avatar Selected');
        }
    }


    


    public function findCities(Request $request)
    {
        $data = City::select('name', 'id')->where('province_id', $request->id)->get();
        return response()->json($data);
    }













}

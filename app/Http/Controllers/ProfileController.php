<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Post;
use App\Profile;
use Auth;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
$users = DB::table('users')->where('id','=',Auth::user()->id)->get();

        return view('profile', ['users' => $users]);
        
       

    }
		public function editProfile(Request $request)
    {
		
		  $this->validate($request,['name' => 'required','mobile' => 'required','profile_image' => 'required','city' => 'required']);
	
	$users = new User;
	$users->name = $request->input('name');
	$users->user_id = Auth::user()->id;
	$users->mobile = $request->input('mobile');
	$users->city = $request->input('city');
	 if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $name = str_slug($request->name).'.'.$image->getClientOriginalExtension();
        $destinationPath = '././uploads';
        $imagePath = $destinationPath. "/".  $name;
        $image->move($destinationPath, $name);
        $users->profile_image = $name;
      }
		DB::table('users')
            ->where('id','=',$users->user_id)
            ->update(['name' => $users->name,'mobile' => $users->mobile,'profile_image' => $users->profile_image,'city' => $users->city]);
		return redirect('/profile')->with('response','Profile Updated SuccessFully');
	 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Like;
use App\Dislike;
use App\Comment;
use App\Post;
use Auth;
class HomeController extends Controller
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
		$posts = Post::all();
/* 		foreach ($posts as $p) 
     echo $pid = $p->id;
	 
	$likes = DB::table('likes') 
	//->select(DB::raw('count(*) as user_id'))
                    ->where('post_id',$pid)
                     ->get();
	 
		$dislikes = DB::table('dislikes')
		->where('post_id',$pid)
		->count();
		$comments = DB::table('comments')
		->where('post_id',$pid)
		->count(); */
       
     return view('home', ['posts' => $posts]);   	 
       
 
    }
    

}

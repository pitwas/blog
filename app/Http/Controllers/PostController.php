<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Post;
use App\Like;
use App\Dislike;
use App\Comment;
use Auth;


class PostController extends Controller
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
		$posts = DB::table('posts')->get();
		$task = 'show';
//print_r($posts);print_r($task);
        return view('post', ['posts' => $posts,'task' => $task]);
         
    }
	public function update($id)
    {
	$pid = explode('*',$id)[0];
	$title = explode('*',$id)[1];
	$body = explode('*',$id)[2];
		$posts = DB::table('posts')
		->where('id','=',$pid)->get();      
			$task = 'up';
 return view('post', ['posts' => $posts,'task' => $task]);
 
   
         
    }	
	public function updatePost($id)
    {
	$pid = explode('*',$id)[0];
	$title = explode('*',$id)[1];
	$body = explode('*',$id)[2];
          $posts = DB::table('posts')
		->where('id','=',$pid)
		 ->update(['title' => $title,'body' => $body]); 
		 	$task = 'up';
		return view('post', ['task' => $task]);
   
         
    }
	public function myPost(Request $request)
    {
		
		$posts = Post::all();
		foreach ($posts as $p) {
     $pid = $p->id;
	 $likes = DB::table('likes')
		->where('post_id','=',$pid,'and','user_id','=',Auth::user()->id)
		->count();
		$dislikes = DB::table('dislikes')
		->where('post_id',$pid)
		->count();
		$comments = DB::table('comments')
		->where('post_id',$pid)
		->count();
        return view('myPost', ['posts' => $posts,'likes' => $likes,'dislikes' => $dislikes,'comments' => $comments]);
		} 	 
    }
	public function addPost(Request $request)
	{
		//return $request->input('title');
		$this->validate($request,['title' => 'required','post_image' => 'required','body' => 'required']);
	

	$posts = new Post;
	$posts->title = $request->input('title');
	$posts->user_id = Auth::user()->id;
	$posts->body = $request->input('body');
	 if ($request->hasFile('post_image')) {
        $image = $request->file('post_image');
        $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
        $destinationPath = '././uploads';
        $imagePath = $destinationPath. "/".  $name;
        $image->move($destinationPath, $name);
        $posts->post_image = $name;
      }
		//$posts->post_image = @$url;
		$posts->save();
		return redirect('/home')->with('response','Post Posted SuccessFully');
	}

}

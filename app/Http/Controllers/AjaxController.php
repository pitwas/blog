<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
	public function ajaxRequest(){
		//return view('home');
		 return view('home', ['likes' => $likes]);
	}
	public function ajaxRequestPost(Request $request){
		 $uid = $request->all();
	//	 print_r($uid);
		 if ($uid['task']=='like')
		 {
			$userid = $uid['uid'][0]; 
    $pid = $uid['uid'][2];
	DB::table('likes')->insert(['user_id' => $userid,'post_id' => $pid]);
	  echo 'hello like';
		 }
			 elseif ($uid['task']=='dislike'){
				 $userid = $uid['uid'][0]; 
    $pid = $uid['uid'][2];
	DB::table('dislikes')->insert(['user_id' => $userid,'post_id' => $pid]);
	
			 echo 'hello dislike';
			 }
			 elseif ($uid['task']=='delete'){
		//	echo	 $userid = $uid['uid'][0]; 
echo       $pid = $uid['uid'][2];
	 DB::table('posts')->where(['id' => $pid])->delete();
	
			 echo 'Successful Deleted';
			 }
		 else{
			 $userid = $uid['uid'][0]; 
    $pid = $uid['uid'][2];
	$msg = $uid['msg'];
	DB::table('comments')->insert(['user_id' => $userid,'post_id' => $pid,'comment' => $msg]);
	
			 echo'comment';
		 }
	
		return response('ok');//->json(['ok' => 'ok']);  
	} 
}

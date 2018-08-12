@extends('layouts.app')
 <script src="{{ asset('js/angular.min.js') }}"></script>
@section('content')
<div class="container" ng-app="my" ng-controller="myController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					 @foreach($posts as $post)
					
<div class="media border p-3">

  <a href="{{ route('profile') }}"> <img class="img-circle" src = "./uploads/{{ Auth::user()->profile_image }}"alt="{{ Auth::user()->name }}" width=50 height=50 style="width:60px;"/></a>
  <div class="media-body">
    <h4>{{ $post->title }} <small class='text-right'><i>{{ $post->created_at }}</i></small></h4>
    <p>{{ $post->body }}</p>
	<img src="././uploads/{{ $post->post_image }}" width="100%" height="50%" alt='NO IMAGE'/>
 </br>
<button class="btn btn-success fa fa-thumbs-o-up" name = 'like' ng-model = 'like' value="{{ $post->user_id .'*'.$post->id }}" ng-click="likes('{{ $post->user_id .'*'.$post->id }}')" title="Like"> <span class='badge'>{{ \App\Like::where(['post_id' => $post->id])->get()->count() }}</span></button>

<button class="btn btn-danger fa fa-thumbs-o-down" ng-model = 'disLike' value='{{ $post->user_id .'*'.$post->id }}'ng-click="disLikes('{{ $post->user_id .'*'.$post->id }}')" title="Disike"><span class='badge'>{{ \App\Dislike::where(['post_id' => $post->id])->get()->count() }}</span></button>
<button class="btn btn-primary fa fa-comment" ng-model = 'comment' value='{{ $post->user_id .'*'.$post->id }}'ng-click="comments('{{ $post->user_id .'*'.$post->id }}')" title="{{ \App\Comment::where(['post_id' => $post->id])->select('comment')->get()}}"><span class='badge'>{{ \App\Comment::where(['post_id' => $post->id])->get()->count() }}</span></button>
  </div>
</div>
     @endforeach  
</div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

var app = angular.module("my",[]);
app.controller("myController",function($scope,$http)
{
$scope.likes = function(id){
	//alert(id)
	 $http({
        method : "POST",
        url : "{{ url()->current()}}/ajaxRequest",
		data:{uid:id,task:'like'}
    }).then(function mySuccess(response) {
        $scope.myWelcome = response.data;
		alert('Post Liked')
		console.log(response)
    }, function myError(response) {
        $scope.myWelcome = response.statusText; 
    });
	
	//alert('hey')
};
	$scope.disLikes = function(id){
		 $http({
        method : "POST",
        url : "{{ url()->current()}}/ajaxRequest",
		data:{uid:id,task:'dislike'}
    }).then(function mySuccess(response) {
        $scope.myWelcome = response.data;
		alert('Post DisLiked')
		console.log(response)
    }, function myError(response) {
        $scope.myWelcome = response.statusText;
    });
	};
	$scope.comments = function(id){
		var msg = window.prompt("Pls Comment Something");
		 $http({
        method : "POST",
        url : "{{ url()->current()}}/ajaxRequest",
		data:{uid:id,msg:msg,task:'comment'}
    }).then(function mySuccess(response) {
        $scope.myWelcome = response.data;
		alert('Comment Successfully Post')
		console.log(response)
    }, function myError(response) {
        $scope.myWelcome = response.statusText;
    });
	};
});
/* var data = new Array(); 
    $(".likes").click(function(){
        alert("The paragraph was clicked.");
		$.ajax({
		method:'POST',
		url:'/ajaxRequest',
		data:{data:data},
		success:function(response){
			alert(response)
		},
		error:function(response)
		{
		alert(response)
		}
	}); 
    });
	
	/* $(".disLikes").click(function(){
	alert('kam kr gya re')
	//alert(data)
});
$(".CommentS").click(function(){
	alert(data)
	//alert('kam kr gya re')
	
});
});
 */


</script>
@endsection

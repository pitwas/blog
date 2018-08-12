@extends('layouts.app')
 <script src="{{ asset('js/angular.min.js') }}"></script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">My Posts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="form-horizontal" ng-app="postDel" ng-controller="delPost">
                        {{ csrf_field() }}

						<div class='table table-responsive'>
						<table class='table table-stripped'>
						<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Image</th>
						<th>Likes</th>
						<th>DisLikes</th>
						<th>Comments</th>
						<th>Date</th>
						<th>Action</th>
						</tr>
						@foreach($posts as $post)
						<tr>
						<td>{{ $post->title }}</td>
						<td>{{ $post->body }}</td><td><img src="././uploads/{{ $post->post_image }}" width="50" height="50" alt='NO IMAGE'/></td>
						<td title="{{ \App\Post::where(['id' => $post->id])->select('user_id')->get()}}">{{ \App\Like::where(['post_id' => $post->id])->get()->count() }}</td>
						<td title="{{ \App\Post::where(['id' => $post->id])->select('user_id')->get()}}">{{ \App\Dislike::where(['post_id' => $post->id])->get()->count() }}</td>
						<td title="{{ \App\Post::where(['id' => $post->id])->select('user_id')->get()}}">{{ \App\Comment::where(['post_id' => $post->id])->get()->count() }}</td>
						<td>{{$post->created_at}}</td>
						<td><a href="{{ url('post/update/'.$post->id.'*'.$post->title.'*'.$post->body) }}"><button class="btn btn-info fa fa-edit" title="Edit Post"></button></a>&nbsp;
						<button class="btn btn-danger fa fa-trash" ng-click="delete('{{ Auth::user()->id .'*'.$post->id}}')" title="Delete Post"></button></td>
						</tr>
						@endforeach
						</table>
						</div>
						
                    <?php /*    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="body"  class="form-control" name="body" required>{{ old('body') }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('post_image') ? ' has-error' : '' }}">
                            <label for="post_image" class="col-md-4 control-label">Upload Image</label>

                            <div class="col-md-6">
                                <input id="post_image" type="file" class="form-control" name="post_image" required>

                                @if ($errors->has('post_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    POST
                                </button>
                            </div>
                        </div> */?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var app = angular.module("postDel",[]);
app.controller("delPost",function($scope,$http)
{
$scope.delete = function(id){
var msg = window.confirm("Are You Sure To Delete a Post?");
if(msg){
$http({
method:'POST',
url:"{{ url()->current()}}/ajaxRequest",
data:{uid:id,task:'delete'}
}).then(function mySuccess(response)
{
alert('Sucessfull Deleted');
}
,function MyError(response)
	{
	alert(response)
	});
	}
	else
	{
	alert('Failed');
	}
};
});
</script>
@endsection

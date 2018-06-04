<div class="card" style="border: hidden;">
<div class="card-body">
	
<form method="POST" action="{{ url('/comments') }}">
    {{ csrf_field() }}

    <div class="row">

    <div class="col-md-1">
    	<img src="{{ url('user-avatar/' . Auth::id() . '/35') }}" class="img-responsive float-left">
    </div>

    <div class="col-md-11">
	    <div class="form-group{{$errors->has('') ? 'has-error' : ''}}">
	    	
	        @if ($errors->has('post_'.$post->id.'_comment_content'))
	            <span class="invalid-feedback d-block">
	                <strong>{{ $errors->first('post_'.$post->id.'_comment_content') }}</strong>
	            </span>
	        @endif

	    <input name="post_{{$post->id}}_comment_content" class="form-control" placeholder="Skomentuj" style="margin-bottom: 10px" value="{{ old('post_'.$post->id.'_comment_content')}}">  

	    <input type="hidden" name="post_id" value="{{$post->id}}">              
	    </div>

	    <button type="submit" class="btn btn-sm btn-default float-right">Dodaj komentarz</button>

	</div>

	</div>
</form>
</div>
</div>

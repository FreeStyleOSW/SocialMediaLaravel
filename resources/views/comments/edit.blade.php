@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 offset-md-3">
			<div class="card">
    			<div class="card-body">
        	<form method="POST" action="{{ url('/comments/'. $comment->id) }}">
    			{{ csrf_field() }}
    			{{ method_field('PATCH')}}

    		<div class="form-group{{$errors->has('') ? 'has-error' : ''}}">
        	@if ($errors->has('comment_content'))
            	<span class="invalid-feedback d-block">
                	<strong>{{ $errors->first('comment_content') }}</strong>
            	</span>
        	@endif
    		<input name="comment_content" class="form-control" placeholder="Treść komentarza" style="margin-bottom: 10px" value=" {{ $comment->content }}">
    		</div>
    		<button type="submit" class="btn btn-primary float-right">Zapisz zmiany</button>
			</form>
			</div>
			</div>
        </div>
    </div>
</div>
@endsection

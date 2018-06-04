@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 offset-md-3">
			<div class="card">
    			<div class="card-body">
        	<form method="POST" action="{{ url('/posts/'. $post->id) }}">
    			{{ csrf_field() }}
    			{{ method_field('PATCH')}}

    		<div class="form-group{{$errors->has('') ? 'has-error' : ''}}">
        	@if ($errors->has('post_content'))
            	<span class="invalid-feedback d-block">
                	<strong>{{ $errors->first('post_content') }}</strong>
            	</span>
        	@endif
    		<textarea name="post_content" class="form-control" rows="5" placeholder="Co słychać ?	" style="margin-bottom: 10px">{{ $post->content }}</textarea>
    		</div>
    		<button type="submit" class="btn btn-primary float-right">Zapisz zmiany</button>
			</form>
			</div>
			</div>
        </div>
    </div>
</div>
@endsection

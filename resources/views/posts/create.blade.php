<div class="card">
<div class="card-body">
<form method="POST" action="{{ url('/posts') }}">
    {{ csrf_field() }}
    <div class="form-group{{$errors->has('') ? 'has-error' : ''}}">
        @if ($errors->has('post_content'))
            <span class="invalid-feedback d-block">
                <strong>{{ $errors->first('post_content') }}</strong>
            </span>
        @endif
    <textarea name="post_content" class="form-control" rows="5" placeholder="Co słychać ?" style="margin-bottom: 10px">{{ old('post_content')}}</textarea>                    
    </div>
    <button type="submit" class="btn btn-default float-right">Dodaj post</button>
</form>
</div>
</div>

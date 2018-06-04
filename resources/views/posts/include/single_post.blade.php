<div class="card">
    <div class="card-body{{$post->trashed() ? ' trashed' : ''}}">
        
        @if (belongs_to_auth($post->user_id) || is_admin())

            @include('posts.include.dropdown_menu')

        @endif


    	<div class="clearfix">
    		<img src="{{ url('user-avatar/' . $post->user->id . '/50') }}" class="img-responsive float-left">
    		<div class="float-left" style="margin: 3px 10px">
    			<a href="{{ url('/users/'. $post->user->id) }}"><strong>{{$post->user->name}}</strong></a><br>
    			<a href="{{ url('/posts/'. $post->id) }}" class="text-muted"><small>{{$post->created_at}}</small></a>
    		</div>
    	</div>

    	<div id="post_{{$post->id}}" style="margin-top: 10px">
    		{{$post->content}}
    	</div>

        
        @include('posts.include.likes')
        
        <hr>

        @if (Auth::check())
            @include('comments.create')
        @endif
        

        @foreach ($post->comments as $comment)
            @include('comments.include.single')
        @endforeach
	
    </div>
</div>
<br/>

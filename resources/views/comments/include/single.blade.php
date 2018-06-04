

@if (!$loop->first)
	<hr style="margin: 10px 0">
@endif

 @if (belongs_to_auth($comment->id) || is_admin())

    @include('comments.include.dropdown_menu')

@endif

<div id="comment_{{$comment->id}}" style="padding: 5px" class="{{$comment->trashed() ? 'trashed' : ''}}">
    <img src="{{ url('user-avatar/' . $comment->user->id . '/35') }}" class="img-responsive float-left">
		<div style="padding-left: 10px; overflow: hidden;">	
    			<a href="{{ url('/users/'. $comment->user->id) }}"><strong>{{$comment->user->name}}</strong></a><br>
    			<a href="{{ url('/posts/'.$post->id . '#comment_' . $comment->id) }}" class="text-muted" style="float: right;"><small>{{$comment->created_at}}</small></a>
				{{$comment->content}}
		</div>

        @include('comments.include.likes')	

</div>

@section('footer')
<script>
	$(function() {
		function addHighlightClass() {
			let hash = window.location.hash.substring(1);
			let comment = document.getElementById(hash);
			let $comment = $(comment).addClass('highlight highlightYellow');
			setTimeout(function() {
				$comment.removeClass('highlightYellow');
			},1500);
		} addHighlightClass();

		window.addEventListener('hashchange',function() {
			addHighlightClass();
		}, false);

	});
</script>


@endsection
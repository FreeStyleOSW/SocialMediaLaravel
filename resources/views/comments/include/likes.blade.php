@if (Auth::check())

	@if (!Auth::user()->likes->contains('comment_id',$comment->id))

		<form style="margin-top: 10px" method="POST" action="{{url('/likes')}}">
		    {{csrf_field()}}
		    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
		    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Polub <span class="badge badge-light">{{$comment->likes->count()}}</span></button>
		</form>

	@else
		<form style="margin-top: 10px" method="POST" action="{{url('/likes')}}">
		    {{csrf_field()}}
		    {{method_field('DELETE')}}
		    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
		    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Odlub <span class="badge badge-light">{{$comment->likes->count()}}</span></button>
		</form>

	@endif

@endif

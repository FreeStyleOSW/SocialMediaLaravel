@if (Auth::check())

	@if (!Auth::user()->likes->contains('post_id',$post->id))

		<form style="margin-top: 10px" method="POST" action="{{url('/likes')}}">
   			{{csrf_field()}}
			    <input type="hidden" name="post_id" value="{{ $post->id }}">
			    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Polub <span class="badge badge-light">{{$post->likes->count()}}</span></button>
			</form>

	@else
		<form style="margin-top: 10px" method="POST" action="{{url('/likes')}}">
		    {{csrf_field()}}
		    {{method_field('DELETE')}}
		    <input type="hidden" name="post_id" value="{{ $post->id }}">
		    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-thumbs-up"></i> Odlub <span class="badge badge-light">{{$post->likes->count()}}</span></button>
		</form>

	@endif

@endif







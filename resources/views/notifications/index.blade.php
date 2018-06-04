@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card ">
            <div class="card-header">
                    Powiadomienia
            </div>
            <div class="card">
                <div class="card-body">

                    @if (Auth::user()->notifications->count() === 0)
                        <h4 class="text-center">Brak powiadomień</h4>
                    @else
                    <ul class="list-group">
                        @foreach (Auth::user()->notifications as $notification)
                       		<li class="list-group-item"  
                       		style="{{!is_null($notification->read_at) ? 'opacity: 0.5' : ''}}">

                       		<?php echo html_entity_decode($notification->data['message']) ?>
                       		
							@if (is_null($notification->read_at))
							<form method="POST" action=
								"{{ url('/notifications/' . $notification->id)  }}" 
								style="float: right;">
                					{{ csrf_field() }}
                					{{ method_field('PATCH') }}
                				<button type="submit" class="btn btn-sm">Przeczytane</button>
							</form>
							@endif


                            </li>
                        @endforeach
                    </ul>
                    @endif

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

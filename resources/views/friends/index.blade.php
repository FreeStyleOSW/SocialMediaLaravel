@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card ">
            <div class="card-header">
                    Lista znajomych 
                    <span class="badge badge-secondary">{{$user->friends()->count()}}</span>
            </div>
            <div class="card">
                <div class="card-body">

                    @if ($user->friends()->count() === 0)
                        <h4 class="text-center">Brak znajomych</h4>
                    @else
                        <div class="row"> 
                        @foreach ($user->friends() as $friend)
                            <div class="col-sm-4 text-center">
                                <a href="{{ url('/users/'. $friend->id) }}">
                                    <div class="img-thumbnail">
                                        <img src="{{ url('user-avatar/'.$friend->id . '/250') }}" class="img-fluid">
                                        <h5 style="margin-top: 5px">{{$friend->name}}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        </div>
                        <div class="text-center">
                        </div>
                    @endif

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

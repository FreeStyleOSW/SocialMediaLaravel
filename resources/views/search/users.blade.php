@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card ">
            <div class="card-header">
                    Wynik wyszukiwania
            </div>
            <div class="card">
                <div class="card-body">

                    @if ($search_results->count() === 0)
                        <h4 class="text-center">Brak wyników</h4>
                    @else
                        <div class="row"> 
                        @foreach ($search_results as $user)
                            <div class="col-sm-4 text-center">
                                <a href="{{ url('/users/'. $user->id) }}">
                                    <div class="img-thumbnail">
                                        <img src="{{ url('user-avatar/'.$user->id . '/250') }}" class="img-fluid">
                                        <h5 style="margin-top: 5px">{{$user->name}}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        </div>
                        <div class="text-center">
                                 {{$search_results}}
                        </div>
                    @endif

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

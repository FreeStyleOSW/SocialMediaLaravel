@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 offset-md-3">

            @if (Auth::check())
            
                     
                @include('posts.create')

                <br>

            @endif

            @foreach ($posts as $post)
                @include('posts.include.single_post')
            @endforeach

            <div>
                {{ $posts }}
            </div>

        </div>
    </div>
</div>
@endsection

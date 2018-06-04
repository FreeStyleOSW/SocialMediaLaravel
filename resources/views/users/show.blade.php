@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-md-7">

            @if (Auth::check() && $user->id === Auth::id())
            
                     
                @include('posts.create')

                <br>

            @endif
            

            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    @include('posts.include.single_post')
                @endforeach
            @else
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Ten użytkownik nie ma żadnych postów</h4>
                    </div>
                </div>
            @endif

            <div>
                {{ $posts }}
            </div>

        </div>
    </div>
</div>
@endsection

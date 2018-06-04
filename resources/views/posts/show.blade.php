@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 offset-md-3">

          @include('posts.include.single_post')

        </div>
    </div>
</div>
@endsection

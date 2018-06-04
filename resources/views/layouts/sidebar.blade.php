<div class="col-md-3 col-md-offset-1">
    <div class="card ">
        <div class="card-header">
            Użytkownik
            @if ($user->id === Auth::id())
                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="float-right">
                <small>Edytuj</small>
                </a>
            @endif      
        </div>

        <div class="card-body text-center">
            <img src="{{ url('user-avatar/' . $user->id . '/250') }}" class="img-thumbnail">
                <h2><a href="{{ url('/users/' . $user->id)}}">{{ $user->name }}</a></h2>
                    <p>@if ($user->sex == 'm')
                            Mężczyzna
                        @else
                            Kobieta
                        @endif
                    </p>
            <p>{{ $user->email }}</p>

            <p><a href="{{ url('/users/' . $user->id . '/friends') }}">Znajomi</a> <span 
                class="badge badge-secondary">{{$user->friends()->count()}}</span></p>

            @if (Auth::check() && $user->id !== Auth::id())
                @if ( ! friendship($user->id)->exists &&  ! has_friend_invitation($user->id))
                
                <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                    {{ csrf_field() }}

                    <button class="btn btn-success">Zaproś do znajomych</button>
                </form>

                @elseif (has_friend_invitation($user->id))

                <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}

                    <button class="btn btn-primary">Przyjmij zaproszenie</button>
                </form>
                   

                @elseif (friendship($user->id)->exists && ! friendship($user->id)->accepted)

                    <button class="btn btn-disabled">Zaproszenie wysłane</button>

                @elseif (friendship($user->id)->exists &&  friendship($user->id)->accepted)

                    <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}

                    <button class="btn btn-danger">Usuń ze znajomych</button>

                @endif
            @endif

        </div>
    </div>
</div>
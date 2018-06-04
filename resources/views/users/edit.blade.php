@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset 3">
            <div class="card">
                <div class="card-header">Edycja użytkownika</div>
                	<div class="card-body">

                		{{-- <img src="{{ asset('storage/users'. $user->id . '/avatars/' . $user->avatar) }}" class="img-fluid"> --}}
                		<div class="text-center">
                			<img src="{{ url('user-avatar/' . $user->id . '/250') }}" 
                			class="img-thumbnail">
                		</div>

                		<form method="POST" action="{{ url('/users/' . $user->id)  }}" 
                			enctype="multipart/form-data">

                			{{ csrf_field() }}
                			{{ method_field('PATCH') }}

							<div class="row">
	                			<div class="col-sm-12">
	                				<div class="form-group">
	                					<label for="">Avatar</label>
	                					<input type="file" name="avatar" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" value="{{ $user->avatar }}"/>
	                					@if ($errors->has('avatar'))
                                   		<span class="invalid-feedback">
                                        	<strong>{{ $errors->first('avatar') }}</strong>
                                   		</span>
                              			@endif
	                				</div>
	                			</div>
	                		</div>



	                		<div class="row">
	                			<div class="col-sm-12">
	                				<div class="form-group">
	                					<label for="">Imię i nazwisko</label>
	                					<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}"/>
	                					@if ($errors->has('name'))
                                   		<span class="invalid-feedback">
                                        	<strong>{{ $errors->first('name') }}</strong>
                                   		</span>
                              			@endif
	                				</div>
	                			</div>
	                		</div>

	                		<div class="row">
	                			<div class="col-sm-12">
	                				<div class="form-group">
	                					<label for="">E-mail</label>
	                					<input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}"/>
	                					@if ($errors->has('email'))
                                   		<span class="invalid-feedback">
                                        	<strong>{{ $errors->first('email') }}</strong>
                                   		</span>
                              			@endif
	                				</div>
	                			</div>
	                		</div>

	                		<div class="row">
	                			<div class="col-sm-12">
	                				<div class="form-group">
	                					<label for="sex">Płeć</label>
	                					<select class="form-control" id="sex" type="text" name="sex">
	                						
	                						<option value="m" @if ($user->sex =='m') selected @endif>
	                						Mężczyzna
	                						</option>

	                						<option value="f" @if ($user->sex =='f') selected @endif>
	                						Kobieta
	                						</option>

	                					</select>
	                				</div>
	                			</div>
	                		</div>

	                		<div class="row">
	                			<div class="col-sm-12">
	                				<div class="form-group">
	                					<button type="submit" 
	                					class="btn btn-primary btn-sm float-right">Zapisz zmiany</button>
	                				</div>
	                			</div>
	                		</div>
                		</form>
               	 	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

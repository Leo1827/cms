@extends('master')

@section('title', 'Editar mi perfil')

@section('content')
<div class="row mtop16">
	<div class="col-md-4">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="far fa-user"></i> Editar avatar</h2>
			</div>
			<div class="inside">
				<div class="edit_avatar">
				{!! Form::open(['url' => 'account/edit/avatar', 'id' => 'form_avatar_change','files' => true]) !!}
					<a href="#" id="btn_avatar_edit">
						<div class="overlay" id="avatar_change_overlay"><i class="fas fa-camera"></i></div>
					@if(is_null(Auth::user()->avatar)) 
						<img src="{{ url('/static/images/default-avatar.png') }}">
					@else
						<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}">
					@endif
					</a> 
				{!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*', 'class' => 'form-control']) !!}
					
				{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="panel shadow mtop32">
			<div class="header">
				<h2 class="title"><i class="fas fa-fingerprint"></i> Cambiar contraseña</h2>
			</div>
			<div class="inside">
				{!! Form::open(['url' => '/account/edit/password']) !!}
				<div class="row">
					<div class="col-md-12">
						<label for="name">Contraseña actual: </label>
						<div class="input-group">
						    <span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						    </span>
						    {!! Form::password('apassword', ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
 
				<div class="row mtop16">
					<div class="col-md-12">
						<label for="name">Nueva contraseña: </label>
						<div class="input-group">
						    <span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						    </span>
						    {!! Form::password('password', ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-12">
						<label for="name">Confirmar contraseña: </label>
						<div class="input-group">
						    <span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard"></i>
						    </span>
						    {!! Form::password('cpassword', ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16 pt-3">
					<div class="col-md-12">
						{!! Form::submit('Actualizar contraseña', ['class' => 'btn btn-success']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="far fa-address-card"></i> Editar información</h2>
			</div>
			<div class="inside">
				{!! Form::open(['url' => '/account/edit/info']) !!}
					<div class="row">
						<div class="col-md-4">
							<label for="name">Nombre:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="fas fa-keyboard"></i>
								</span>
								{!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="col-md-4">
							<label for="lastname">Apellidos: </label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="fas fa-keyboard"></i>
								</span>
								{!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="col-md-4">
							<label for="email">Correo electrónico: </label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="fas fa-keyboard"></i>
								</span>
								{!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
							</div>
						</div>
					</div>

					<div class="row mtop16">
						<div class="col-md-4">
							<label for="phone">Teléfono: </label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
									<i class="fas fa-keyboard"></i>
								</span>
								{!! Form::number('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="col-md-8">
								<label for="module" class="">Fecha de nacimiento: Año - mes - día</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
								</span>
								{!! Form::number('year', $birthday[0], ['class' => 'form-control', 'min' => getUserYears()[1], 'max' => getUserYears()[0], 'required']) !!}
								{!! Form::select('month', getMonths('list', null), $birthday[1], ['class' => 'form-select']) !!}
								{!! Form::number('day', $birthday[2], ['class' => 'form-control', 'min' => 1, 'max' => 31, 'required']) !!}
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 mtop16">
								<label for="module" class="">Género: </label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
								</span>
								{!! Form::select('gender', ['0' => 'Sin especificar', '1' => 'Hombre', '2' => 'Mujer'], Auth::user()->gender, ['class' => 'form-select']) !!}
							</div>
						</div>
					</div>

				<div class="row mtop16">
					<div class="col-md-12">
						{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>


</div>
@endsection
@extends('admin.master')

@section('title','Categorias')

@section('breadcrumb')
<li class="breadcrumb-item ">
	<a href="{{ url('/admin/categories/0') }}"  style="text-decoration: none;"><i class="fas fa-folder-open"></i> Categorias</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
            <div class="container-fluid">
	      		<div class="panel shadow">
		     		<div class="header">
					 <h2 class="title"><i class="fas fa-edit"></i> Editar categoria</h2>
		     		</div>

		    	 	<div class="inside">
		     		{!! Form::open(['url' =>'/admin/category/'.$cat->id.'/edit', 'files' => true]) !!}
		     		<label for="name">Nombre categoria:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
					</div>

					<label for="module" class="mtop16">Módulo:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select']) !!}
					</div>

					<label for="icon" class="mtop16">Ícono:</label>
					<div class="form-file">
						{!! Form::file('icon', ['class' => 'form-file-input','id' => 'customFile', 'accept' => 'image/*']) !!}
						<label class="form-file-label"  for="customFile">
					</label>
					</div>

					{!! Form::submit('Editar', ['class' => 'btn btn-success mtop16']) !!}
		     		{!! Form::close() !!}
		     		</div>
	    		</div>
            </div>
		</div>

		@if(!is_null($cat->icono))
		<div class="col-md-3">
            <div class="container-fluid">
	      		<div class="panel shadow">
		     		<div class="header">
					 <h2 class="title"><i class="fas fa-edit"></i> Icono</h2>
		     		</div>

		    	 	<div class="inside">
		     		<img src="{{ url('/upload/'.$cat->file_path.'/'.$cat->icono) }}" class="img-fluid">
		     		</div>
	    		</div>
            </div>
		</div>
		@endif

	</div>
</div>
@endsection
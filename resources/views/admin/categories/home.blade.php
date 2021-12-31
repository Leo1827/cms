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
			 <h2 class="title"><i class="fas fa-plus"></i> Agregar categoria</h2>
		     </div>

		     <div class="inside">
		     	@if(kvfj(Auth::user()->permissions, 'category_add'))
		     	{!! Form::open(['url' =>'/admin/category/add', 'files' => 'true']) !!}
		     	<label for="name">Nombre categoria:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
						</span>
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
					</div>

					<label for="module" class="mtop16">Módulo:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1">
							<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
						</span>
					{!! Form::select('module', getModulesArray(), 0, ['class' => 'form-select']) !!}
					</div>

					<label for="icon" class="mtop16">Ícono:</label>
					<div class="form-file">
						{!! Form::file('icon', ['class' => 'form-file-input', 'required','id' => 'customFile', 'accept' => 'image/*']) !!}
						<label class="form-file-label"  for="customFile">
					</label>
					</div>


				{!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
		     	{!! Form::close() !!}
		     	@endif
		     </div>
	    </div>
            </div>
		</div>

		<div class="col-md-9">
            <div class="container-fluid">
	            <div class="panel shadow">
		             <div class="header">
			         <h2 class="title"><i class="fas fa-folder-open"></i> Categorias</h2>
		             </div>

		             <div class="inside">
		             	<nav class="nav nav-pills nav-fill">
		             		@foreach(getModulesArray() as $m => $k)
		             		<a class="nav-link" href="{{ url('/admin/categories/'.$m) }}"><i class="fas fa-list"></i> {{ $k }}</a>
		             		@endforeach
		             	</nav>
		             	<table class="table mtop16">
		             		<thead>
		             			<tr>
		             				<td width="94"></td>
		             				<td>Nombre</td>
		             				<td width="100"></td>
		             			</tr>
		             		</thead>
		             		<tbody>
		             			@foreach($cats as $cat)
		             			<tr>
		             				<td>
										 @if(!is_null($cat->icono))
										 <img src="{{ url('/upload/'.$cat->file_path.'/'.$cat->icono) }}" class="img-fluid">
										 @endif
									 </td>
		             				<td>{{ $cat->name }}</td>
		             				<td>
		             					<div class="opts">
		             				@if(kvfj(Auth::user()->permissions, 'category_edit'))
										<a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
											<i class="fas fa-edit"></i>
										</a>
									@endif
									@if(kvfj(Auth::user()->permissions, 'category_delete'))
										<a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
											<i class="fas fa-trash-alt"></i>
										</a>
									@endif
										</div>
		             				</td>
		             			</tr>
		             			@endforeach
		             		</tbody>
		             	</table>
		             </div>
	            </div>
            </div>
		</div>
	</div>
</div>
@endsection
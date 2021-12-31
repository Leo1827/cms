@extends('admin.master')

@section('title','Editar producto')

@section('breadcrumb')
<li class="breadcrumb-item ">
	<a href="{{ url('/admin/products/all') }}"  style="text-decoration: none;"><i class="fas fa-edit"></i> Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
	         <div class="panel shadow">
		          <div class="header">
			          <h2 class="title"><i class="fas fa-edit"></i> Editar producto</h2>
		          </div>

		          <div class="inside">
			{!! Form::open(['url' => '/admin/product/'.$p->id.'/edit', 'files' => true]) !!}
			<div class="row">

				<div class="col-md-6">
					<label for="name">Nombre del producto:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-6">
					<label for="category">Categoría:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select']) !!}
					</div>
				</div>

				<div class="col-md-3 mt-3">
					<label for="name">Imagen Destacada:</label>
					<div class="custom-file">
					{!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
					<label class="custom-file-label"  for="customFile"></label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="price">Precio:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0,00', 'step' => 'any']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="indiscount">¿En descuento:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'form-select']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="discount">Descuento:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="status">Estado:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $p->status, ['class' => 'form-select']) !!}
					</div>
				</div>

			</div>

			<div class="row mtop16">
				<div class="col-md-3">
				<label for="inventory">Inventario:</label>
					<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
					{!! Form::number('inventory', $p->inventory, ['class' => 'form-control', 'min' => '0.00']) !!}
					</div>
				</div>

				<div class="col-md-3">
				<label for="code">Codígo de sistema:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
							</span>
						</div>
					{!! Form::text('code', $p->code, ['class' => 'form-control']) !!}
					</div>
				</div>	
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					<label for="content"> Descripción:</label>
					{!! Form::textarea('content', $p->content, ['class' => 'form-control', 'id' => 'editor']) !!}
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					{!! Form::submit('Editar', ['class' => 'btn btn-success']) !!}
				</div>
			</div>

			{!! Form::close() !!}
		          </div>
	          </div>
        </div>

	    <div class="col-md-3">
	    	<div class="panel shadow">
	    		<div class="header">
	    			<h2 class="title"><i class="fas fa-image"></i> Imagen Destacada</h2>
	    			<div class="inside">
	    				<img src="{{ url('/upload/'.$p->file_path.'/'.$p->image) }} " class="img-fluid">
	    			</div>
	    		</div>
	    	</div>

	    	<div class="panel shadow mtop16">
	    		<div class="header">
	    		    <h2 class="title"><i class="fas fa-images"></i> Galería</h2>
	    	    </div>
	    	<div class="inside product_gallery">
	    	@if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
	    		{!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
	    		{!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;','required']) !!}
	    		{!! Form::close() !!}

	    		<div class="btn-submit">
	    			<a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
	    		</div>
	    	@endif
	    		<div class="tumbs">
	    			@foreach($p->getGallery as $img)
	    			<div class="tumb">
	    			@if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
	    				<a href="{{ url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
						<i class="fas fa-trash-alt"></i>
						</a>
					@endif
						<img src="{{ url('/upload/'.$img->file_path.'/t_'.$img->file_name) }}">
	    			</div>
	    			@endforeach
	    		</div>

	    	</div>
	    </div>
	</div>
</div>
@endsection
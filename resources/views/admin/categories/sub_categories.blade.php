@extends('admin.master')

@section('title','Categorías')

@section('breadcrumb')
<li class="breadcrumb-item ">
	<a href="{{ url('/admin/categories/0') }}"  style="text-decoration: none;"><i class="fas fa-folder-open"></i> Categorías</a>
</li>
<li class="breadcrumb-item ">
	<a href="{{ url('/admin/categories/0') }}"  style="text-decoration: none;"><i class="fas fa-folder-open"></i> Categoría {{ $category->name }}</a>
</li>
<li class="breadcrumb-item ">
	<a href="#"  style="text-decoration: none;"><i class="fas fa-folder-open"></i> Subcategorías</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
            <div class="container-fluid">
	            <div class="panel shadow">
		             <div class="header">
			         <h2 class="title"><i class="fas fa-folder-open"></i> Subcategorías de <strong>{{ $category->name }}</strong></h2>
		             </div>

		             <div class="inside">
		             	<table class="table mtop16">
		             		<thead>
		             			<tr>
		             				<td width="94"></td>
		             				<td>Nombre</td>
		             				<td width="140"></td>
		             			</tr>
		             		</thead>
                             <tbody>
                                @foreach($category->getSubCategories as $cat)
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
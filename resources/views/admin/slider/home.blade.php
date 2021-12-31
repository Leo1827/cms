@extends('admin.master')

@section('title','Modulo Sliders')

@section('breadcrumb')
<li class="breadcrumb-item ">
	<a href="{{ url('/admin/sliders') }}"  style="text-decoration: none;"><i class="far fa-images"></i> Sliders</a>
</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'slider_add'))
                <div class="panel shadow">
                    <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i> Agregar Slide</h2>
                    </div>
       
                    <div class="inside">
                        {!! Form::open(['url' =>'/admin/slider/add', 'files' => 'true']) !!}
                            <label for="name">Nombre:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::text('name', null, ['class' => 'form-control']) !!}
                           </div>
       
                           <label for="module" class="mtop16">Visible:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], 1, ['class' => 'form-select']) !!}
                           </div>
       
                           <label for="icon" class="mtop16">Imagen destacada:</label>
                           <div class="form-file">
                               {!! Form::file('img', ['class' => 'form-file-input','id' => 'customFile', 'accept' => 'image/*']) !!}
                               <label class="form-file-label"  for="customFile">
                           </label>
                           </div>

                           <label for="name" class="mtop16">Contenido:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
                           </div>

                           <label for="name" class="mtop16">Orden de aparición:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::number('sorder', 0, ['class' => 'form-control', 'min' => '0']) !!}
                           </div>
       
       
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                        
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                    <h2 class="title"><i class="far fa-images"></i> Sliders</h2>
                    </div>
       
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td width="180px">
                                        <img src="{{ url('/upload/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                                    </td>
                                    <td><div class="slider_content">
                                        <h1>{{ $slider->name }}</h1>
                                        {!! html_entity_decode($slider->content) !!}
                                        </div>
                                    </td>
                                    <td width="100px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'slider_edit'))
                                               <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                   <i class="fas fa-edit"></i>
                                               </a>
                                           @endif
                                           @if(kvfj(Auth::user()->permissions, 'slider_delete'))
                                                <a href="#" data-path="admin/slider" data-action="delete" data-object="{{ $slider->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-deleted">
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
@endsection
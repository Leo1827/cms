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
            <div class="col-md-5">
                @if(kvfj(Auth::user()->permissions, 'slider_edit'))
                <div class="panel shadow">
                    <div class="header">
                    <h2 class="title"><i class="far fa-edit"></i> Editar Slide</h2>
                    </div>
       
                    <div class="inside">
                        {!! Form::open(['url' =>'/admin/slider/'.$slider->id.'/edit']) !!}
                            <label for="name">Nombre:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
                           </div>
       
                           <label for="module" class="mtop16">Visible:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], $slider->status, ['class' => 'form-select']) !!}
                           </div>
       
                           <label for="icon" class="mtop16">Imagen destacada:</label>
                           <div class="row">
                               <div class="col-md-4">
                                <img src="{{ url('/upload/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                               </div>
                           </div>
                           
                           <label for="name" class="mtop16">Contenido:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::textarea('content', html_entity_decode($slider->content), ['class' => 'form-control', 'rows' => '3']) !!}
                           </div>

                           <label for="name" class="mtop16">Orden de aparición:</label>
                           <div class="input-group">
                               <span class="input-group-text" id="basic-addon1">
                                   <i class="far fa-keyboard" style="width: 16px; height: 24px;"></i>
                               </span>
                           {!! Form::number('sorder', $slider->sorder, ['class' => 'form-control', 'min' => '0']) !!}
                           </div>
       
       
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                        
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@extends('master')

@section('title', 'Inicio')

@section('content')
<section>
    <div class="home_action_bar shadow">
        <div class="row">
            {{--Menu desplegable fronted, categorias--}}
            <div class="col-md-3">
                <div class="categories shadow">
                    <a href="#"><i class="fas fa-stream"></i> Categorias</a>
                    <ul class="shadow">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ url('/store/category'.$category->id.'/'.$category->slug) }}">
                                <img src="{{ url('/upload/'.$category->file_path.'/'.$category->icono) }}" alt="">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{--Fin Menu desplegable fronted, categorias--}}

            {{--Barra de busqueda--}}
            <div class="col-md-9">
                {!! Form::open(['url' => '/search']) !!}
                <div class="input-group shadow">
                    <i class="fas fa-search"></i>
                    {!! Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => '¿Buscas algo?', 'required']) !!}
                    <button class="btn" type="submit" id="button-addon2">Buscar</button>
                </div>
                {!! Form::close() !!}
            </div>
            {{--Fin de barra de busqueda--}}
        </div>
    </div>
</section>
<section>
    {{--Slider--}}
    @include('components/sliders_home')
    {{--Fin slider--}}
</section>

<section>
    {{--Sección de productos--}}
    <div class="products_list" id="products_list"></div>

    <div class="load_more_products">
        <a href="#" id="load_more_products">Cargar mas productos</a>
    </div>
    {{--fin Sección de productos--}}
</section>

@endsection
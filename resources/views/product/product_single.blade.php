@extends('master')

@section('title', $product->name)

@section('content')
<!-- Producto individual  - Inicio !-->
    <div class="product_single">
        <div class="container">
            <div class="row">
                <!-- Imagen de producto y galeria de ese producto !-->
                <div class="col-md-4 pleft0">
                    <div class="slick-slider">
                        <div>
                            <a href="{{ url('/upload/'.$product->file_path.'/t_'.$product->image) }}" data-fancybox="gallery">
                                <img src="{{ url('/upload/'.$product->file_path.'/t_'.$product->image) }}" class="img-fluid">
                            </a>
                        </div>
                        @if(count($product->getGallery) > 0)
                            @foreach($product->getGallery as $gallery)
                            <div>
                                <a href="{{ url('/upload/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" data-fancybox="gallery">
                                    <img src="{{ url('/upload/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" class="img-fluid">
                                </a>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <h2 class="title">{{ $product->name }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
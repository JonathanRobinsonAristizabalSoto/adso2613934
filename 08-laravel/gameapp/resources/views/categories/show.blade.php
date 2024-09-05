{{-- Ubicación: gameapp/resources/views/categories/show.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'View Category')
@section('class', 'cuerpo')

@section('content')
    <header>
        <section class="cabecera_categories">
            <a href="{{ route('categories.index') }}">
                <img class="icoback-dash" src="{{ asset('images/btn_back.png') }}" alt="Back Button">
            </a>
            <img class="logotitulo-dash" src="{{ asset('images/logo-cabecera_categories.svg') }}" alt="Logo">
        </section>
    </header>

    <section class="scroll">
        <div class="contenedor_titulos_parrafos_view">
            <div class="img_perfiles">
                <img class="img_perfil_usuario"
                    src="{{ $category->image ? asset('images/' . $category->image) : asset('images/no-photo.png') }}"
                    alt="Category Image">
            </div>
            <h1 class="titulo_viewcategories">{{ $category->name }}</h1>
            <div class="subcontenedor_show_grillcategories">
                <p class="parrafo_view">{{ $category->manufacturer }}</p>
                <p class="parrafo_view">{{ $category->releasedate }}</p>
                <p class="parrafo_view">{{ $category->description }}</p>
            </div>
        </div>
    </section>
@endsection

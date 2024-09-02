{{-- Ubicación: gameapp/resources/views/categories.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'Categories Module')
@section('class', 'cuerpo')

@section('content')
    <!-- cabecera -->
    <header>
        <section class="cabecera_categories">
            <!-- Enlace al dashboard -->
            <a href="{{ route('dashboard') }}">
                <img class="icoback-dash" src="{{ asset('images/btn_back.png') }}" alt="Back Button">
            </a>
            <img class="logotitulo-dash" src="{{ asset('images/logo-cabecera_categories.svg') }}" alt="Logo">

            <!-- Incluir Menú hamburguesa -->
            @include('includes.burger-menu')
        </section>
    </header>

    <section class="scroll">

        <!-- Mensajes de éxito y error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- caja de busqueda -->
        <div class="search-box">
            <input type="text" placeholder="Buscar">
            <i class="fas fa-filter filter-icon"></i>
        </div>

        <!-- boton add -->
        <div class="botonuser">
            <a href="{{ route('categories.create') }}">
                <button class="btn-user">
                    <img src="{{ asset('images/content-btn-add.svg') }}" alt="Add Category">
                </button>
            </a>
        </div>

        <!-- contenido dashboard -->
        <section class="contenedor_modulos_dash">
            @foreach ($categories as $category)
                <section class="contenedor_dash">
                    <section class="contenido_dash">
                        <!-- Contenedor para la imagen de categories en miniatura -->
                        <div class="img_perfil_miniatura">
                            <img class="img_perfil_usuario_miniatura"
                                src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/no-photo.png') }}"
                                alt="category Thumbnail">
                        </div>
                        <div class="titulo_modulo">
                            <p>{{ $category->name }}</p>
                        </div>
                        <div class="parrafo_modulo">
                            <h3>{{ $category->manufacturer }}</h3>
                        </div>

                        <!-- Botónes para ver editar y borrar categories -->
                        <div class="boton_view_dash">
                            <!-- Botón de ver -->
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-explore">
                                <i class="fa-regular fa-eye icon-white icon-thin"></i>
                            </a>
                            <!-- Botón de editar -->
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-edit">
                                <i class="fa-regular fa-pen-to-square icon-white icon-thin"></i> <!-- Icono de editar -->
                            </a>
                            <!-- Botón de eliminar -->
                            <a href="{{ route('categories.delete', $category->id) }}" class="btn btn-delete">
                                <i class="fa-regular fa-trash-can icon-white icon-thin"></i> <!-- Icono de eliminar -->
                            </a>
                        </div>
                    </section>
                </section>
            @endforeach
        </section>
    </section>
@endsection

@section('js')
    <script>
        // Script para el menú hamburguesa
        $('header').on('click', '.btn-burger', function() {
            $(this).toggleClass('active');
            $('.nav').toggleClass('active');
            $('.contenido_menu').toggleClass('oculto');
        });
    </script>
@endsection

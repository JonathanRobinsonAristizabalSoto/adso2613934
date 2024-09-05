@extends('layouts.plantilla2')

@section('title', 'Games Module')
@section('class', 'cuerpo')

@section('content')
    <!-- cabecera -->
    <header>
        <section class="cabecera_gamer">
            <a href="{{ route('dashboard') }}">
                <img class="icoback-gamer" src="{{ asset('images/btn_back.png') }}" alt="Back Button">
            </a>
            <img class="logotitulo-gamer" src="{{ asset('images/logo-cabecera_games.svg') }}" alt="Logo">

            <!-- Incluir Menú hamburguesa -->
            @include('includes.burger-menu')
        </section>
    </header>

    <section class="scroll">
        <!-- caja de busqueda -->
        <div class="search-box">
            <input type="text" placeholder="Buscar">
            <i class="fas fa-filter filter-icon icon-white icon-thin"></i>
        </div>
        <!-- boton add -->
        <div class="botonuser">
            <form action="{{ route('games.create') }}">
                <button class="btn-user" type="submit">
                    <i class="fas fa-plus icon-white icon-thin"></i> <!-- Icono de añadir -->
                </button>
            </form>
        </div>

        <!-- contenido games -->
        <section class="contenedor_modulos_dash">
            @foreach ($games as $game)
                <section class="contenedor_dash">
                    <section class="contenido_dash">

                        <!-- Contenedor para la imagen de games en miniatura -->
                        <div class="img_perfil_miniatura">
                            <img src="{{ asset('storage/' . $game->image) }}" alt="Game Image" class="img-contenedor-dash">
                        </div>
                        <div class="texto-contenedor-dash">
                            <div class="titulo_modulo">
                                <p>{{ $game->title }}</p>
                            </div>
                            <div class="parrafo_modulo">
                                <p>{{ $game->category->manufacturer }}</p>
                            </div>
                        </div>

                        <!-- Botónes para ver editar y borrar games -->
                        <div class="boton_view_dash">
                            <!-- Botón de ver -->
                            <a href="{{ route('games.show', $game->id) }}" class="btn btn-explore">
                                <i class="fa-regular fa-eye icon-white icon-thin"></i>
                            </a>
                            <!-- Botón de editar -->
                            <a href="{{ route('games.edit', $game->id) }}" class="btn btn-edit">
                                <i class="fa-regular fa-pen-to-square icon-white icon-thin"></i> <!-- Icono de editar -->
                            </a>
                            <!-- Botón de eliminar -->
                            <a href="{{ route('games.destroy', $game->id) }}" class="btn btn-delete">
                                <i class="fa-regular fa-trash-can icon-white icon-thin"></i></i> <!-- Icono de eliminar -->
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
        $('header').on('click', '.btn-burger', function() {
            $(this).toggleClass('active');
            $('.nav').toggleClass('active');
            $('.contenido_menu').toggleClass('oculto');
        });
    </script>
@endsection

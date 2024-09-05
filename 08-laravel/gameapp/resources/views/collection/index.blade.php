{{-- Ubicación: resources/views/collection/index.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'My Collection')
@section('class', 'cuerpo')

@section('content')
    <header>
        <section class="cabecera_dash">
            <img class="logotitulo-dash" src="{{ asset('images/logo-cabecera_dashboard.svg') }}" alt="Logo">

            {{-- Menú hamburguesa --}}
            @include('includes.burger-menu')
        </section>
    </header>

    <section class="contenedor_modulos_dash">
        <h2>My Collection</h2>

        @foreach($categories as $categoryName => $games)
            <section class="contenedor_dash">
                <section class="contenido_dash">
                    <img src="{{ asset('images/ico-category.png') }}" alt="Ícono de categoría" class="img-contenedor-dash">
                    <div class="texto-contenedor-dash">
                        <div class="parrafo_modulo">
                            <h3>{{ $categoryName }}</h3>
                        </div>
                    </div>
                </section>

                @foreach($games as $game)
                    <section class="contenido_dash">
                        <img src="{{ $game->image ? asset('storage/' . $game->image) : asset('images/no-image.png') }}" alt="Game Image" class="img-contenedor-dash">
                        <div class="texto-contenedor-dash">
                            <div class="parrafo_modulo">
                                <h4>{{ $game->title }}</h4>
                                <p>{{ $game->developer }}</p>
                                <p>{{ $game->releasedate }}</p>
                            </div>
                        </div>
                    </section>
                @endforeach
            </section>
        @endforeach
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Collection page loaded');

            // Manejo del menú hamburguesa
            document.querySelector('header').addEventListener('click', function(event) {
                if (event.target.closest('.btn-burger')) {
                    console.log('Burger menu button clicked');
                    document.querySelector('.btn-burger').classList.toggle('active');
                    document.querySelector('.nav').classList.toggle('active');
                    document.querySelector('.contenido_menu').classList.toggle('oculto');
                }
            });
        });
    </script>
@endsection

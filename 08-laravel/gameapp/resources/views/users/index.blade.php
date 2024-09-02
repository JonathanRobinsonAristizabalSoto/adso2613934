{{-- Ubicación del archivo: gameapp/resources/views/users/index.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'Users Module')
@section('class', 'cuerpo')

@section('content')
    <!-- Encabezado principal de la página -->
    <header>
        <section class="cabecera_users">
            <!-- Botón de retroceso -->
            <a href="{{ url('dashboard') }}">
                <img class="icoback-users" src="{{ asset('images/btn_back.png') }}" alt="Back Button">
            </a>
            <!-- Logo del encabezado -->
            <img class="logotitulo-users" src="{{ asset('images/logo-cabecera_users.svg') }}" alt="Logo">

            <!-- Incluir Menú hamburguesa -->
            @include('includes.burger-menu')
        </section>
    </header>

    <section class="scroll">
        <!-- Caja de búsqueda -->
        <div class="search-box">
            <input id="qsearch" type="text" placeholder="Buscar">
            <i class="fas fa-filter filter-icon"></i>
        </div>

        <!-- Sección de lista de usuarios -->

        <!-- Botón para agregar un nuevo usuario -->
        <div class="botonuser">
            <form action="{{ url('users/create') }}">
                <button class="btn-user" type="submit">
                    <img src="{{ asset('images/content-btn-add.svg') }}" alt="Add User">
                </button>
            </form>
        </div>

        <!-- Lista de usuarios -->
        <div id="list">
            <section class="contenedor_modulos_dash">
                @foreach ($users as $user)
                    <section class="contenedor_dash">
                        <section class="contenido_dash">
                            <!-- Contenedor para la imagen de perfil en miniatura -->
                            <div class="img_perfil_miniatura">
                                <img class="img_perfil_usuario_miniatura"
                                    src="{{ $user->photo ? asset('images/' . $user->photo) : asset('images/no-photo.png') }}"
                                    alt="User Thumbnail">
                            </div>
                            <!-- Texto del contenedor de usuario -->
                            <div class="texto-contenedor-dash">
                                <div class="titulo_modulo">
                                    <h4>{{ $user->fullname }}</h4>
                                </div>
                                <div class="parrafo_modulo">
                                    <p>{{ $user->role }}</p>
                                </div>
                            </div>
                            <!-- Botón para ver editar e inabilitar usuarios -->
                            <div class="contenedor-status {{ $user->status ? 'activo' : 'inactivo' }}">
                                <p>{{ $user->status ? 'Activo' : 'Inactivo' }}</p> <!-- Estado del usuario -->
                            </div>

                            <div class="boton_view_dash">
                                <!-- Botón de ver -->
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-explore">
                                    <i class="fa-regular fa-eye icon-white icon-thin"></i>
                                </a>
                                <!-- Botón de editar -->
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">
                                    <i class="fa-regular fa-pen-to-square icon-white icon-thin"></i>
                                    <!-- Icono de editar -->
                                </a>
                                <!-- Botón de deshabilitar usuario -->
                                <a href="{{ route('users.disable', $user->id) }}" class="btn btn-status">
                                    <i class="fa-solid fa-user-slash icon-white icon-thin"></i>
                                    <!-- Icono de deshabilitar -->
                                </a>
                            </div>
                        </section>
                    </section>
                @endforeach
            </section>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // Script para el menú hamburguesa
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('header').addEventListener('click', function(event) {
                if (event.target.closest('.btn-burger')) {
                    document.querySelector('.btn-burger').classList.toggle('active');
                    document.querySelector('.nav').classList.toggle('active');
                }
            });
        });

        // Script para búsqueda en tiempo real
        $(document).ready(function() {
            $('body').on('keyup', '#qsearch', function(e) {
                e.preventDefault();
                var query = $(this).val();
                var token = '{{ csrf_token() }}';

                $.post('/users/search', {
                    query: query,
                    _token: token
                }, function(data) {
                    $('#list').html(data);
                });
            });
        });
    </script>
@endsection

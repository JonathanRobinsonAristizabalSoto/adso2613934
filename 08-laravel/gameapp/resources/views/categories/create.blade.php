{{-- Ubicación: gameapp/resources/views/categories/create.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'Create Category')
@section('class', 'cuerpo')

@section('content')
    <header>
        <section class="cabecera_add">
            <div>
                <a href="{{ route('categories.index') }}">
                    <img class="icoback-add" src="{{ asset('images/btn_back.png') }}" alt="Back Button">
                </a>
                <img class="logotitulo" src="{{ asset('images/logo-cabecera_add.svg') }}" alt="Logo">
            </div>
            <!-- Menú hamburguesa -->
            <div class="burger-menu">
                <svg class="btn-burger" viewBox="0 0 100 100" width="80">
                    <path class="line top"
                        d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                    <path class="line middle" d="m 70,50 h -40" />
                    <path class="line bottom"
                        d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
                </svg>
                <!-- Navegación del menú hamburguesa -->
                <nav class="nav">
                    <section class="contenedor_titulos_myprofile2">
                        {{-- Foto del usuario --}}
                        <div class="img_perfiles">
                            <img class="img_perfil_usuario"
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/no-photo.png') }}"
                                alt="Profile Image">
                        </div>
                        {{-- Datos del usuario --}}
                        <section>
                            <div>
                                {{-- Nombre del usuario --}}
                                <div class="titulo_myprofile">
                                    <p>{{ Auth::user()->fullname }}</p>
                                    <!-- Muestra el nombre del usuario autenticado -->
                                </div>
                                {{-- Rol del usuario --}}
                                <div class="boton_role"> <!-- Muestra el rol del usuario autenticado -->
                                    <div>
                                        <p>{{ Auth::user()->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Menú de navegación del perfil -->
                        <menu class="contenedor_titulo_myprofile">
                            <a href="{{ url('profile') }}">
                                <img src="{{ asset('images/ico-profyle.png') }}" alt="Profile Icon">
                                My Profile
                            </a>
                            <hr>
                            <a href="{{ url('dashboard') }}">
                                <img src="{{ asset('images/ico-conf.png') }}" alt="Dashboard Icon">
                                Dashboard
                            </a>
                            <hr>
                            <!-- Formulario para cerrar sesión -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <img src="{{ asset('images/ico-logout.png') }}" alt="Log Out Icon">
                                LogOut
                            </a>
                            <hr>
                        </menu>
                    </section>
                </nav>
            </div>
        </section>
    </header>

    <!-- Registro -->
    <section class="scroll">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="contenedor_titulos_cajas_register">
            @csrf
            <div id="imagenContenedor">
                <div id="uploadText">
                    <p>Upload Category Image</p>
                </div>
                <img class="img_perfil_usuario" src="{{ asset('images/transparent.png') }}" alt="Category Image">
                <input type="file" id="inputFile" name="image" accept="image/*">
            </div>

            <section class="contenedor_titulo_caja_register">
                <label class="titulo_register">
                    <h3>Category Name</h3>
                </label>
                <div class="caja">
                    <input type="text" name="name" placeholder="Enter category name"
                        value="{{ old('name') }}" required>
                </div>
            </section>
            <section class="contenedor_titulo_caja_register">
                <label class="titulo_register">
                    <h3>Manufacturer</h3>
                </label>
                <div class="caja">
                    <input type="text" name="manufacturer" placeholder="Enter manufacturer" value="{{ old('manufacturer') }}" required>
                </div>
            </section>
            <section class="contenedor_titulo_caja_register">
                <label class="titulo_register">
                    <h3>Release Date</h3>
                </label>
                <div class="caja">
                    <input type="date" name="releasedate" placeholder="Enter release date" value="{{ old('releasedate') }}" required>
                </div>
            </section>
            <section class="contenedor_titulo_caja_register">
                <label class="titulo_register">
                    <h3>Description</h3>
                </label>
                <div class="caja">
                    <textarea name="description" placeholder="Enter description">{{ old('description') }}</textarea>
                </div>
            </section>
            {{-- boton de registro --}}
            <div class="botonregister">
                <button type="submit" class="btn btn-explore">
                    <img class="content-btn2-footer" src="{{ asset('images/content-btn-add.svg') }}"
                        alt="Add Category">
                </button>
            </div>
        </form>
    </section>
@endsection

@section('js')
    {{-- script menu hamburguesa --}}
    <script>
        // Ocultar todo el contenido y luego mostrarlo suavemente
        $('#page-content').hide().fadeIn(400);
    </script>
    <script>
        $('header').on('click', '.btn-burger', function() {
            $(this).toggleClass('active');
            $('.nav').toggleClass('active');
            $('.contenido_menu').toggleClass('oculto');
        });
    </script>

    {{-- script photo upload --}}
    <script>
        $(document).ready(function() {
            $('#inputFile').on('change', function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#imagenContenedor').find('img').attr('src', event.target.result);
                    $('#uploadText').hide();
                }
                reader.readAsDataURL(file);
            });

            // Permitir al usuario seleccionar una imagen al hacer clic en cualquier parte del contenedor
            $('#imagenContenedor').click(function() {
                $('#inputFile').click();
            });
        });
    </script>

    {{-- Display errors with SweetAlert2 --}}
    <script>
        @if (count($errors) > 0)
            let errorHtml = '';
            @foreach ($errors->all() as $error)
                errorHtml += '<li>{{ $error }}</li>';
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<ul>' + errorHtml + '</ul>',
                showConfirmButton: false,
                timer: 4000
            });
        @endif
    </script>
@endsection
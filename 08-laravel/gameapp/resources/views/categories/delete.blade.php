{{-- Ubicación: gameapp/resources/views/categories/delete.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'Delete Category')
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
        <div class="delete-confirmation">
            <h1>¿Estás seguro de que deseas eliminar esta categoría?</h1>
            <p>Nombre: {{ $category->name }}</p>
            <p>Fabricante: {{ $category->manufacturer }}</p>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </section>
@endsection

{{-- Ubicación: gameapp/resources/views/categories/edit.blade.php --}}

@extends('layouts.plantilla2')

@section('title', 'Edit Category')
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
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="caja">
                <input type="text" name="name" value="{{ $category->name }}" placeholder="Name">
            </div>
            <div class="caja">
                <input type="text" name="manufacturer" value="{{ $category->manufacturer }}" placeholder="Manufacturer">
            </div>
            <div class="caja">
                <input type="date" name="releasedate" value="{{ $category->releasedate }}" placeholder="Release Date">
            </div>
            <div class="caja">
                <input type="file" name="image">
            </div>
            <div class="caja">
                <textarea name="description" placeholder="Description">{{ $category->description }}</textarea>
            </div>
            <div class="botonuser">
                <button type="submit">Update Category</button>
            </div>
        </form>
    </section>
@endsection

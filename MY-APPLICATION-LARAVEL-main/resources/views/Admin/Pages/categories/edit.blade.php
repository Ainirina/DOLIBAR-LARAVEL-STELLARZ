@extends('admin.Layouts.Elements.ElementLayout')
@section('title', 'Edit ' . ($category->name ?? 'Categorie'))
@section('element.active', 'categories')

@section('element')
<div class="container">
    <h2>Modifier la Catégorie</h2>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nom de la catégorie :</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Mettre à Jour</button>
    </form>
    <form action="{{ route('categories.destroy', $category) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">
            <i class="pi pi-trash" aria-hidden="true"></i> Delete
        </button>
    </form>
</div>
@endsection
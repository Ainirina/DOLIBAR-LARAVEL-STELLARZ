@extends('admin.Layouts.Elements.ElementLayout')
@section('title', 'Edit ' . ($category->name ?? 'Categorie'))
@section('element.active', 'categories')

@section('element')
<div class="container">
    <h2>Créer une Nouvelle Catégorie</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nom de la catégorie :</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
    </form>
</div>
@endsection
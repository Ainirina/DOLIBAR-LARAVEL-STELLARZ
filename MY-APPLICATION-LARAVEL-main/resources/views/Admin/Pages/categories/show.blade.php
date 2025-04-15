@extends('admin.Layouts.Elements.ElementLayout')
@section('title', 'Edit ' . ($category->name ?? 'Categorie'))
@section('element.active', 'categories')

@section('element')
<div class="container">
    <h2>Détails de la Catégorie</h2>
    <p><strong>ID :</strong> {{ $category->id }}</p>
    <p><strong>Nom :</strong> {{ $category->name }}</p>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
@extends('admin.Layouts.Elements.ElementLayout')
@section('title', ($product->name ?? 'Product'))
@section('element.active', 'products')

@section('element')

<h1>Product Details</h1>
<p>Name: {{ $product->name }}</p>
<p>Model: {{ $product->model }}</p>
<p>Price: ${{ $product->price }}</p>

<h2>Categories:</h2>
<ul>
    @foreach($categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</ul>
<a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>


@endsection
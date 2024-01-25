@extends('layouts.app')

@section('content')
    <h1>Détails du Produit</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>Libelle:</strong> {{ $product->libelle }}</p>
    <p><strong>Marque:</strong> {{ $product->marque }}</p>
    <p><strong>Prix:</strong> {{ $product->prix }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>
    <p><strong>Image:</strong> {{ $product->image }}</p>

    <a href="{{ route('products.edit', $product->id) }}">
        <button>Modifier</button>
    </a>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection

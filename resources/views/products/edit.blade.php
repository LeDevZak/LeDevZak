@extends('layouts.app')

@section('content')
    <h1>Modifier le Produit</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="libelle">Libelle:</label>
        <input type="text" name="libelle" value="{{ $product->libelle }}" required>

        <label for="marque">Marque:</label>
        <input type="text" name="marque" value="{{ $product->marque }}" required>

        <label for="prix">Prix:</label>
        <input type="text" name="prix" value="{{ $product->prix }}" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}" required>

        <label for="image">Image:</label>
        <input type="file" name="image" value="{{ $product->image }}">

        <button type="submit">Mettre à Jour</button>
    </form>
@endsection

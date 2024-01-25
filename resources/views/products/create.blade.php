@extends('layouts.app')

@section('content')
    <h1>Créer un Nouveau Produit</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="libelle">Libelle:</label>
        <input type="text" name="libelle" required>

        <label for="marque">Marque:</label>
        <input type="text" name="marque" required>

        <label for="prix">Prix:</label>
        <input type="text" name="prix" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>

        <label for="image">Image:</label>
        <input type="file" name="image">

        <button type="submit">Créer</button>
    </form>
@endsection

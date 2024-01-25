@extends('layouts.app')

@section('content')
    <h1>Liste des Produits</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}">
        <button style="margin-bottom: 10px;">Créer un nouveau produit</button>
    </a>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 20%;">Libelle</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 20%;">Marque</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 15%;">Prix</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 15%;">Stock</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; width: 30%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->libelle }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->marque }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->prix }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $product->stock }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <a href="{{ route('products.show', $product->id) }}">
                            <button style="border: 1px solid #ddd; padding: 5px;">Voir</button>
                        </a> |
                        <a href="{{ route('products.edit', $product->id) }}">
                            <button style="border: 1px solid #ddd; padding: 5px;">Modifier</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="border: 1px solid #ddd; padding: 8px;">Aucun produit disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

<h1>Edit Product</h1>

@if ($product)
    <form method="POST" action="{{ route('products.update', $product['id']) }}">
        @csrf
        @method('PUT')
        <label for="libelle">Libelle:</label>
        <input type="text" name="libelle" value="{{ old('libelle', $product['libelle'] ?? '') }}" required>
        <br>
        <label for="marque">Marque:</label>
        <input type="text" name="marque" value="{{ old('marque', $product['marque'] ?? '') }}" required>
        <br>
        <label for="prix">Prix:</label>
        <input type="number" name="prix" value="{{ old('prix', $product['prix'] ?? '') }}" step="0.01" required>
        <br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ old('stock', $product['stock'] ?? '') }}" required>
        <br>
        <label for="image">Image (optional):</label>
        <input type="file" name="image" value="{{ old('image', $product['image'] ?? '') }}">
        <br>
        <button type="submit">Update</button>
    </form>
@else
    <p>Product not found</p>
@endif

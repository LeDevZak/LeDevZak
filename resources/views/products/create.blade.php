<h1>Create Product</h1>
<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <label for="libelle">Libelle:</label>
    <input type="text" name="libelle" required>
    <br>
    <label for="marque">Marque:</label>
    <input type="text" name="marque" required>
    <br>
    <label for="prix">Prix:</label>
    <input type="number" name="prix" step="0.01" required>
    <br>
    <label for="stock">Stock:</label>
    <input type="number" name="stock" required>
    <br>
    <label for="image">Image (optional):</label>
    <input type="file" name="image">
    <br>
    <button type="submit">Create</button>
</form>

<h1>Products</h1>
<a href="{{ route('products.create') }}">Create Product</a>
<table>
    <thead>
        <tr>
            <th>Libelle</th>
            <th>Marque</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product['libelle'] }}</td>
                <td>{{ $product['marque'] }}</td>
                <td>{{ $product['prix'] }}</td>
                <td>{{ $product['stock'] }}</td>
                <td>
                    <a href="{{ route('products.show', $product['id']) }}">Details</a>
                    <a href="{{ route('products.edit', $product['id']) }}">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $product['id']) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

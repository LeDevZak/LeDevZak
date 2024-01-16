<h1>Product Details</h1>

@if($product)
    <p>Libelle: {{ $product['libelle'] }}</p>
    <p>Marque: {{ $product['marque'] }}</p>
    <p>Prix: {{ $product['prix'] }}</p>
    <p>Stock: {{ $product['stock'] }}</p>

    @if(isset($product['image']))
        <p>Image: {{ $product['image'] }}</p>
    @endif
@else
    <p>Product not found</p>
@endif

<a href="{{ route('products.index') }}">Back to Products</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <!-- Add any necessary CSS or styling links here -->
</head>
<body>
    <h1>Posts</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <h3 class="text-red-500 hover:red-600">{{ $post->title }}</h3>
                <h3>Slug</h3>
                <p>{{ $post->slug }}</p>
                <h3>Body</h3>
                <p>{!! $post->body !!}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>

<?php

namespace App\Imports;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Get the currently authenticated user's ID
        $userId = Auth::id();

        // Create a new Post instance and set the published_at field
        $post = new Post([
            'category_id' => $row['category_id'],
            'slug' => $row['slug'],
            'title' => $row['title'],
            'thumbnail' => $row['thumbnail'],
            'excerpt' => $row['excerpt'],
            'body' => $row['body'],
            'published_at' => $row['published_at'] !== 'NULL' ? $row['published_at'] : null, // Check if published_at is 'NULL'
            'user_id' => $userId,
        ]);

        $post->save();
    }
}





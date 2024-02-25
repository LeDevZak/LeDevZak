<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::all([
            'user_id',
            'category_id',
            'slug',
            'title',
            'thumbnail',
            'excerpt',
            'body',
            'published_at',
        ]);
    }
}

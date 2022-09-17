<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        // $categories = Category::select('id','title')->orderBy('title')->get();
        // $tags = Tag::select('id', 'name')->get();

        $tags = Tag::select('id', 'name')->orderByDesc(
            DB::table('post_tag')
                ->selectRaw('count(tag_id) as tag_count')
                ->whereColumn('tags.id', 'post_tag.tag_id')
                ->orderBy('tag_count','desc')
                ->limit(1)
        )->get();

        $latest_posts = Post::select('id','title')->latest()->take(5)->withCount('comments')->get()->toArray(); // good candidate for replacing with redis database

        dump(/* $categories, */ $tags, $latest_posts);

    }
}

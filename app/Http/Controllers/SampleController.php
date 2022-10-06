<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Post;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SampleController extends Controller
{
//    public function index()
//    {
//        $tags = Tag::select('id', 'name')->orderByDesc(
//            DB::table('post_tag')
//                ->selectRaw('count(tag_id) as tag_count')
//                ->whereColumn('tags.id', 'post_tag.tag_id')
//                ->orderBy('tag_count','desc')
//                ->limit(1)
//        )->withCount('posts')->get();
//
//        $latest_posts = Post::select('id','title')->latest()->take(5)->withCount('comments')->get()->toArray(); // good candidate for replacing with redis database
//
//        dump($latest_posts);
//    }


    public function index()
    {
//        $most_popular_posts = Post::select('id', 'title')->orderByDesc(
//            Comment::selectRaw('count(post_id) as comment_count')
//                ->whereColumn('posts.id', 'comments.post_id')
//                ->orderBy('comment_count', 'desc')
//                ->limit(1)
//        )->withCount('comments')->take(5)->toSql();

        $most_active_users = User::select('id','name')->orderByDesc(
            Post::selectRaw('count(user_id) as post_count')
                ->whereColumn('users.id', 'posts.user_id')
                ->orderBy('post_count','desc')
                ->limit(1)
        )
            ->withCount('posts')
            ->take(3)
            ->get();


        dump($most_active_users);
    }
}

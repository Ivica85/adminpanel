<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){

        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $commentsCount = Comment::count();


        return view('admin/index',compact('postsCount','categoriesCount','commentsCount'));
    }

}

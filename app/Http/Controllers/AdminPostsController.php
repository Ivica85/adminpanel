<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        $input = $request->all();
        $user = Auth::user();

        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName($file);
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }


        $user->posts()->create($input);
        Session::flash('created_post',"The post has been created");
        return redirect('admin/posts');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit',compact(['post','categories']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        $user = Auth::user();
        $post = Post::find($id);

        if($user->id == $post->user_id){
            if($file = $request->file('photo_id')){
                $name = time().$file->getClientOriginalName($file);
                $file->move('images',$name);
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
            $user->posts()->whereId($id)->first()->update($input);
        }else{
            Session::flash('update_error',"Error. This post is not belonging to you.");
            return redirect('admin/posts');
        }


        Session::flash('updated_post',"The post has been updated");
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        if($user->id == $post->user_id){
            if($post->photo_id){
                unlink(public_path().$post->photo->file);
            }
            Session::flash('deleted_post','The post has been deleted');
            $post->delete();
        }else{
            Session::flash('deleted_error',"Error. This post is not belonging to you.");

        }


        return redirect('admin/posts');
    }

    public function post($id){

        $post = Post::findOrFail($id);
        $comments = $post->comments()->where('is_active',1)->get();

        return view('post',compact('post','comments'));
    }
}

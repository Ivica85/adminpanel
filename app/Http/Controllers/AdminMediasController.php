<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName($file);
        $file->move('images',$name);

        Session::flash('created_media','The media file has been created');

        Photo::create(['file'=>$name]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


    public function deleteMedia(Request $request){


        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
            $photos = Photo::findOrFail($request->checkBoxArray);


            foreach($photos as $photo){
                if(file_exists(public_path() . $photo->file)){
                    unlink(public_path() . $photo->file);
                }
                $photo->delete();

                $users = User::all();
                foreach($users as $user){
                    if($user->photo_id == $photo->id){
                        $user->photo_id = null;
                        $user->update();
                    }

                }

                $posts = Post::all();
                foreach($posts as $post){
                    if($post->photo_id == $photo->id){
                        $post->photo_id = null;
                        $post->update();
                    }

                }

                $comments = Comment::all();
                foreach($comments as $comment){
                    if($comment->photo == $photo->file){
                        $comment->photo = null;
                        $comment->update();
                    }

                }

                $replies = CommentReply::all();
                foreach($replies as $reply){
                    if($reply->photo == $photo->file){
                        $reply->photo = null;
                        $reply->update();
                    }

                }


            }



            Session::flash('checkboxed_media_deleted','The media file has been deleted');

            return redirect('/admin/media');
        }else{
            return back();
        }



    }
}

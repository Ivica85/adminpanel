<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Photo;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        if(trim($request->password == '')){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }



        if($file = $request->photo_id){
            $name = time().$file->getClientOriginalName($file);
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }



        User::create($input);
        Session::flash('created_user',"The user has been created");
        return redirect('admin/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         $user = User::findOrFail($id);
         $roles = Role::all();
         return view('admin.users.edit',compact(['user','roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {

        $user = User::find($id);



        if(!$user->isAdmin() || auth::id() == $user->id){

            if(trim($request->password) == ''){
                $input = $request->except('password');
            } else{
                $input = $request->all();
                $input['password'] = bcrypt($request->password);
            }




            if($file = $request->photo_id){
                $name = time().$file->getClientOriginalName($file);
                $file->move('images',$name);
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }


            //        $request->validate([
            //            'email' => 'required|email|unique:users,email,'.$user->id,
            //        ]);

            $user->update($input);


            //Comments
            $comments = Comment::all();

            foreach($comments as $comment){
                if( $user->email == $comment->email){
                    $comment->author = $user->name;
                    $user->photo_id != null ? $comment->photo = $user->photo->file : $comment->photo = "";
                    $comment->update();
                }

            }

            //Replies
            $replies = CommentReply::all();

            foreach($replies as $reply){
                if( $user->email == $reply->email){
                    $reply->author = $user->name;
                    $user->photo_id != null ? $reply->photo = $user->photo->file : $reply->photo = "";
                    $reply->update();
                }

            }

            Session::flash('updated_user',"The user has been updated");


        }else{
            Session::flash('updated_user_error',"This user is an admin and you don't have permission to update.");
        }
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if(!$user->isAdmin() || auth::id() == $user->id){
            if ($user->photo_id) {
                unlink(public_path() . $user->photo->file);
                $user->photo->delete();
            }
            $user->delete();

            Session::flash('deleted_user', 'The user has been deleted');

        }else{
            Session::flash('deleted_user_error',"This user is an admin and you don't have permission to delete.");
        }
        return redirect('/admin/users');

    }
}

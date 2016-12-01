<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
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
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //

        $input = $request->all(); //ge all the data from form=create post

        $user = Auth::user();  //get the current user logged in

        if ($file = $request->file('photo_id')){  //ga detect if na exists naba ni xa
            $name = time() . $file->getClientOriginalName(); //get the name of file concat with time

            $file->move('images', $name); //move ang file dd2 sa public directory dayun mag create sa directory name images

            $photo = Photo::create(['file'=>$name]); //create a name of photo to the photos table to the column file

            $input['photo_id'] = $photo->id; //assign a photo_id to the users table

        }

        $user->posts()->create($input);
        return redirect('/admin/posts');

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

        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();


        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        //

        $input = $request->all();

        if ($file = $request->file('photo_id')){  //ga detect if na exists naba ni xa
            $name = time() . $file->getClientOriginalName(); //get the name of file concat with time

            $file->move('images', $name); //move ang file dd2 sa public directory dayun mag create sa directory name images

            $photo = Photo::create(['file'=>$name]); //create a name of photo to the photos table to the column file

            $input['photo_id'] = $photo->id; //assign a photo_id to the users table

        }

        Auth::user()->posts()->whereId($id)->first()->update($input);

        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::findOrFail($id);

        unlink(public_path(). $post->photo->file);

        $post->delete();

        Session::flash('deleted_post', 'The post has been deleted');

        return redirect('/admin/posts');


    }
}

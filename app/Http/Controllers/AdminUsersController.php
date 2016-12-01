<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminUsersController
 * @package App\Http\Controllers
 */
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $roles = Role::lists('name', 'id')->all();  //pulling the array if lists
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        //request gali ang file dle e apil




        if (trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }




        //ge himo ni xa kay sa request empty man ang file
        if ($file = $request->file('photo_id')){  //ga detect if na exists naba ni xa
            $name = time() . $file->getClientOriginalName(); //get the name of file concat with time

            $file->move('images', $name); //move ang file dd2 sa public directory dayun mag create sa directory name images

            $photo = Photo::create(['file'=>$name]); //create a name of photo to the photos table to the column file

            $input['photo_id'] = $photo->id; //assign a photo_id to the users table

        }

        $input['password'] = bcrypt($request->password); //assign the password ngad2 sa users table nga encrypt gkan ni xa sa request

        User::create($input);//tanang request ge create xa

        return redirect('/admin/users');

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
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);



        if (trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }

        //ge himo ni xa kay sa request empty man ang file
        if ($file = $request->file('photo_id')){  //ga detect if na exists naba ni xa
            $name = time() . $file->getClientOriginalName(); //get the name of file concat with time

            $file->move('images', $name); //move ang file dd2 sa public directory dayun mag create sa directory name images

            $photo = Photo::create(['file'=>$name]); //create a name of photo to the photos table to the column file

            $input['photo_id'] = $photo->id; //assign a photo_id to the users table

        }

        $input['password'] = bcrypt($request->password);

        $user->update($input);

        return redirect('/admin/users');
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

        unlink(public_path(). $user->photo->file);

        $user->delete();

        Session::flash('deleted_user', 'The user has been deleted');


        return redirect('/admin/users');
    }

}

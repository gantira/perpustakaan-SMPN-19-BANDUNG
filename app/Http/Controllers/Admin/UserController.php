<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserRequest;
use App\User;
use File;
use Mail;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('status')->get();

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::pluck('name', 'name');

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $requestData = $request->except('roles');
        $roles = $request->roles;

        if (User::role('head of library')->first()) {
            Session::flash('message', '<i class="fe fe-check mr-2" aria-hidden="true"></i>Can not add another Head of Library'); 
            Session::flash('alert-class', 'alert-success');
            
            return redirect()->route('users.index');
        }

        if ($request->file('image')) {
            $destinationPath = public_path('upload/users/');
            $fileName = time() . '-' . str_slug($request->name) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $requestData['image'] = $fileName;
        }
        
        $user = User::create($requestData);
        $user->assignRole($roles);

        Mail::send('emails.mail', $user->toArray(), function($message) use($user) {
            $message->to($user->email, $user->name)
                    ->subject('no reply');
            $message->from('headoflibrary19bdg@gmail.com','Head Of Library 19 Bandung');
        });

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::findOrFail($id);

        return view('admin.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::pluck('name', 'name');

        return view('admin.user.edit', $data);
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
        $requestData = $request->except('roles');
        $roles = $request->roles;
        
        $user = User::findOrFail($id);

        if ($request->file('image')) {
            $this->delete_image($user->image);
            
            $destinationPath = public_path('upload/users/');
            $fileName = time() . '-' . str_slug($request->name) .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $fileName);
            $requestData['image'] = $fileName;
        }

        $user->update($requestData);
        $user->syncRoles($roles);

        return redirect()->route('users.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $this->delete_image($user->image);

        return redirect()->route('users.index');
    }

    public function delete_image($value='')
    {
        $image_path = public_path('upload/users/'. $value);

        if (File::exists($image_path) && $value != 'user.png') {
            File::delete($image_path);
        }
    }
}

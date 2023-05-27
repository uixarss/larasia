<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use App\Siswa;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class UsersController extends Controller
{

    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $data_roles = Role::all();
        $data_permissions = Permission::all();


        return view('admin.users.index', compact('users','data_roles','data_permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if (Gate::denies('edit-users')) {
        //   return redirect()->route('admin.users.index');
        // }

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.edit')->with([
          'user' => $user,
          'roles' => $roles,
          'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        $user->name = $request->name;

        $user->email = $request->email;

        if ($user->save()) {
          $request->session()->flash('success', $user->name . 'berhasil diubah!');
        }else{
          $request->session()->flash('error', $user->name . 'There was  an error update the user');
        }

        return redirect()->back()->with(['success' => 'Berhasil update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete-users')) {
          return redirect()->route('admin.users.index');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }


    public function dashboard()
    {
      return view('guru.dashboard.index');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Auth::logout();
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } else {

            return redirect()->back();
        }

    }




    public function tambahRoles(Request $request)
    {
        $roles = Role::create([
            'name' => $request->name_roles
        ]);

        return redirect()->route('admin.users.index');
    }
    public function tambahPermission(Request $request)
    {
        $permissions = Permission::create([
            'name' => $request->name_permission
        ]);

        return redirect()->route('admin.users.index');
    }


    public function updateRoles(Request $request, $id)
    {
        $roles = Role::find($id);

        $roles->update([
            'name' => $request->name_roles
        ]);

        return redirect()->route('admin.users.index');
    }
    public function updatePermission(Request $request, $id)
    {
        $permissions = Permission::find($id);

        $permissions->update([
            'name' => $request->name_permission
        ]);

        return redirect()->route('admin.users.index');
    }

    public function deleteRoles($id)
    {
        $roles = Role::find($id);

        $roles->delete($roles);

        return redirect()->route('admin.users.index');
    }

    public function deletePermission($id)
    {
        $permissions = Permission::find($id);

        $permissions->delete($permissions);

        return redirect()->route('admin.users.index');
    }

    public function tambahAdmin(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $role = Role::where('name', 'admin')->first();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->roles()->attach($role);

        return redirect()->back();
    }
}

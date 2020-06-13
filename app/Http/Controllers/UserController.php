<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   public function index()
   {
        $user = User::with('roles')->orderBy('created_at', 'DESC')->when(request()->q, function($user){
            $user->where('name', 'LIKE', '%' . request()->q . '%')->
            orWhere('email', 'LIKE', '%' . request()->q . '%');
        })->paginate(2);
        // return $user;
        return view('user.index', compact('user'));
   }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password),
           'role' => $request->role,
       ]);
       $user->assignRole($request->role);

       return redirect(route('user.index'))->with(['success' => 'User berhasil ditambahkan']);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string'
        ]);

        DB::beginTransaction();
        try{
            $user = User::find($id);
            /*
            $password = $user->password;

            if($request->password != '') {
                $password = bcrypt($request->password);
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
            ]);
            */
            $data = request()->only('name', 'email');
            if ($request->password != '') {
                $password = bcrypt($request->password);
            }
            $user->update($data);
            //Proses memberikan role ke user ..Kondisi update meggunakan Sync jika ADD menggunakan assignTo
            $user->syncRoles([$request->role]);
            DB::commit();
            return redirect(route('user.index'))->with(['success' => 'Data user berhasil diperbaharui']);
        } catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        $roles = Role::orderBy('created_at', 'DESC')->get();
        return view('user.edit', compact('user', 'roles'));
    }


    public function create()
    {
        $roles = Role::orderBy('created_at', 'DESC')->get();
        return view('user.create', compact('roles'));
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect(route('user.index'))->with(['success' => 'User' .$user->name . 'berhasil dihapus']);
    }
}

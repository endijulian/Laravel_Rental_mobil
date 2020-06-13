<?php

namespace App\Http\Controllers;

use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::orderBy('created_at', 'DESC')->when(request()->q, function($role){
            $role->where('name', 'LIKE', '%' .request()->q . '%');
        })->paginate(10);
        return view('role.index', compact('role'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|string'
        ]);
        Role::create([
            'name' => $request->role
        ]);

        return redirect()->back()->with(['success'=> 'Role berhasil ditambahkan']);
    }


    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->back()->with(['success' => 'Role berhasil dihapus']);
    }

    //Melihat permission berdasarkan role id
    public function showPermission($id)
    {
        $role = Role::with(['permissions'])->find($id);
        $permission = Permission::select('id', 'name')->get()->groupBy(function($item){
            $explode = explode('_', $item->name);
            return $explode[0];
        });
        $rolePermissions = $role->permissions->pluck('name')->all();
        return view('role.permission', compact('role', 'permission', 'rolePermissions'));
    }

    public function addNewPermission(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required'
        ]);
        
        Permission::create([
            'name' => $request->permission
        ]);

        return redirect()->back()->with(['success'=>'Permission berhasil ditambahkan']);
    }


    public function assignPermissionToRole(Request $request, $id)
    {
        // return $request->permission;  //buat check apakah ygdicentang sudah masuk
        //ambil role
        $role = Role::find($id);
        if ($request->permission){
            $role->syncPermissions($request->permission); //fungsi sync permission untuk menerapkan permission ke dalam role
            return redirect()->back()->with(['success' => 'Assign permission berhasil diterapkan']);
        }
        return redirect()->back()->with(['error' => 'Pilih permission terlebih dahulu!']);
    }
}

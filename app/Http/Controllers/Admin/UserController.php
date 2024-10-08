<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'cellphone' => 'required|unique:users,cellphone,' . auth()->user()->id,
        ]);
        try {
            DB::beginTransaction();

            $user->update([
                "name" => $request->name,
                "cellphone" => $request->cellphone,
            ]);
            $user->syncRoles($request->role);
            $permissions = $request->except(['_token', '_method', 'name', 'cellphone', 'role']);
            $user->syncPermissions($permissions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش کاربر', $e->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('با تشکر', 'کاربر مورد نظر ویرایش شد.');
        return redirect()->route('admin.users.index');
    }
}

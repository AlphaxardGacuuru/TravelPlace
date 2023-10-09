<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use App\Models\Admin\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin.staff.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.staff.create')
            ->with(["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string",
            "email" => "required|string",
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->email);
        $admin->photo = "user-1.jpg";

        DB::transaction(function () use ($admin, $request) {
            $admin->save();

            foreach ($request->roles as $role) {
                $userRole = new UserRole;
                $userRole->admin_id = $admin->id;
                $userRole->role_id = $role;
                $userRole->save();
            }

        });

        return redirect()
            ->route('admin.staff.index')
            ->with('success', $admin->name . ' created successfully!');
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
        $roles = Role::all();

        $getAdmin = Admin::find($id);

        $admin = new AdminResource($getAdmin);

        return view("admin.staff.edit")
            ->with([
                "admin" => $admin,
                "roles" => $roles,
            ]);
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
        $admin = Admin::find($id);

        if ($request->filled("name")) {
            $admin->name = $request->name;
        }

        if ($request->filled("email")) {
            $admin->email = $request->email;
        }

        if ($request->filled("roles")) {
            foreach ($request->input("roles") as $roleId) {
                // Check if role already exists
                $userRoleDoesntExist = UserRole::where("admin_id", $admin->id)
                    ->where("role_id", $roleId)
                    ->doesntExist();

                if ($userRoleDoesntExist) {
                    $userRole = new UserRole;
                    $userRole->admin_id = $admin->id;
                    $userRole->role_id = $roleId;
                    $userRole->save();
                } else {
                    // Remove roles not included
                    UserRole::where("admin_id", $admin->id)
                        ->whereNotIn("role_id", $request->roles)
                        ->delete();
                }
            }
        } else {
            // Remove roles not included
            UserRole::where("admin_id", $admin->id)
                ->delete();
        }

        $admin->save();

        return redirect()
            ->route('admin.staff.edit', ['staff' => $admin->id])
            ->with('success', $admin->name . ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        // Delete Roles
        UserRole::where("admin_id", $admin->id)->delete();

        // Delete Admin
        $admin->delete();

        return redirect()
            ->route("admin.staff.index")
            ->with("success", $admin->name . " deleted successfully");
    }
}

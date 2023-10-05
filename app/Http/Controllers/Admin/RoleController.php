<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\Admin\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view("admin.roles.index", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entities = [
            "dashboard_settings",
            "general_settings",
            "page_settings",
            "payment_settings",
            "blog_section",
            "destinations",
            "packages",
            "dynamic_pages",
            "language",
            "web_section",
            "order",
            "traveller",
            "email_template",
            "subscriber",
            "staff",
        ];

        $CRUD = ["create", "read", "update", "delete"];

        return view("admin.roles.create")
            ->with([
                "entities" => $entities,
                "CRUD" => $CRUD,
            ]);
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
            "name" => "required|string|unique:roles",
            "description" => "string",
            "entities" => "required",
        ]);

        $role = new Role;
        $role->name = $request->input("name");
        $role->description = $request->input("description");
        $role->entities = $request->input("entities");
        $role->save();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', $role->name . ' created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $entities = [
            "dashboard_settings",
            "general_settings",
            "page_settings",
            "payment_settings",
            "blog_section",
            "destinations",
            "packages",
            "dynamic_pages",
            "language",
            "web_section",
            "order",
            "traveller",
            "email_template",
            "subscriber",
            "staff",
        ];

        $CRUD = ["create", "read", "update", "delete"];

        return view("admin.roles.edit")
            ->with([
                "role" => $role,
                "entities" => $entities,
                "CRUD" => $CRUD,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "unique:roles",
        ]);

        $role = Role::find($id);

        if ($request->filled("name")) {
            $role->name = $request->input("name");
        }

        if ($request->filled("description")) {
            $role->description = $request->input("description");
        }

        if ($request->filled("entities")) {
            $role->entities = $request->input("entities");
        }

        $role->save();

        return redirect()
            ->route("admin.roles.edit", ["role" => $role->id])
            ->with("success", $role->name . " updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        // Delete Roles
        UserRole::where("role_id", $role->id)->delete();

        // Delete Role
        $role->delete();

        return redirect()
            ->route("admin.roles.index")
            ->with("success", $role->name . " deleted successfully");
    }
}

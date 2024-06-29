<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    public static $pageTitle = 'Role';
    public static $pageDescription = 'Roles Description';
    public static $modelName = 'App\Models\Role';
    public static $type_menu = 'role';
    public static $pageBreadcrumbs = [
        [
            'page' => '/application/roles',
            'title' => 'List Role',
        ]
    ];
    function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->middleware('permission:role-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        // $roles = Role::join("role_has_permissions","role_has_permissions.role_id","=","roles.id")
        // ->join("permissions","permissions.id","=","role_has_permissions.permission_id")
        // ->select('roles.name', 'permissions.name')
        // ->get();

        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        // ->where("role_has_permissions.role_id",$id)
        // ->get();
        // dd($roles);
        $pageTitle = self::$pageTitle;
        $pageBreadcrumbs = self::$pageBreadcrumbs;

        return view('role.index', compact('roles', 'pageTitle', 'pageBreadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $permissions = Permission::get();

        $pageTitle = self::$pageTitle;
        $pageBreadcrumbs = self::$pageBreadcrumbs;
        $pageBreadcrumbs[] = [
            'page' => '/application/roles/create',
            'title' => 'Create Role',
        ];

        return view('role.create', compact('role', 'permissions', 'pageTitle', 'pageBreadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        $req = $request->all();
        $role = Role::create([
            'name' => $req['name'],
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($req['permission']);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        $pageTitle = self::$pageTitle;
        $pageBreadcrumbs = self::$pageBreadcrumbs;
        $pageBreadcrumbs[] = [
            'page' => '/application/roles/'.$id,
            'title' => 'Show Role',
        ];

        return view('role.show', compact('role', 'rolePermissions', 'pageTitle', 'pageBreadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $pageTitle = self::$pageTitle;
        $pageBreadcrumbs = self::$pageBreadcrumbs;
        $pageBreadcrumbs[] = [
            'page' => '/application/roles/'.$id.'/edit',
            'title' => 'Update Role',
        ];

        return view('role.edit', compact('role', 'permissions', 'rolePermissions', 'pageTitle', 'pageBreadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        request()->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);

        $req = $request->all();
        $role->update([
            'name' => $req['name'],
        ]);
        $role->syncPermissions($req['permission']);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($id) {
            Role::find($id)->delete();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        } else {
            return redirect()->route('roles.index')
                ->with('failed', 'Role deleted failed because id is empty or null');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Excel;
use Dompdf\Dompdf;
use App\Exports\UserExport;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public static $pageTitle = 'User';

    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // $users = User::all();
        if ($req->ajax()) {
            $draw = $req->get('draw');
            $start = $req->get("start");
            $rowperpage = $req->get("length"); // total number of rows per page

            $columnIndex_arr = $req->get('order');
            $columnName_arr = $req->get('columns');
            $order_arr = $req->get('order');
            $search_arr = $req->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
            $searchValue = $search_arr['value']; // Search value

            // Total records
            $totalRecords = User::select('count(*) as allcount')->count();
            $totalRecordswithFilter = User::select('count(*) as allcount')
                ->where('users.name', 'like', '%' . $searchValue . '%')
                ->orwhere('users.username', 'like', '%' . $searchValue . '%')
                ->orWhere('users.email', 'like', '%' . $searchValue . '%')
                ->count();

            // Get records, also we have included search filter as well
            $records = User::orderBy($columnName, $columnSortOrder)
                ->where('users.name', 'like', '%' . $searchValue . '%')
                ->orwhere('users.username', 'like', '%' . $searchValue . '%')
                ->orWhere('users.email', 'like', '%' . $searchValue . '%')
                // ->select('users.name')
                ->with('roles')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $records,
            );

            return response()->json($response, 200);
        }
        $pageTitle = self::$pageTitle;

        // return view('user.index', compact('users', 'pageTitle'));
        return view('user.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        // $roles = Role::pluck('name', 'name')->all();
        $pageTitle = self::$pageTitle;
        
        $missingDataRoleUserForOption = Role::whereNotExists(function ($query) {
            $query->select('id')
                  ->from('model_has_roles')
                  ->whereColumn('roles.id', 'model_has_roles.role_id');
        })
        ->get();
        return view('user.create', compact('user', 'pageTitle', 'missingDataRoleUserForOption'));
    }
    
    public function store(Request $req)
    {
        request()->validate(User::$rules);

        $req = $req->all();
        $req['password'] = Hash::make($req['password']);
        $user = User::create($req);
        $user->assignRole($req['roles']);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $pageTitle = self::$pageTitle;

        return view('user.show', compact('user', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name')->first();
        $missingDataRoleUserForOption = Role::whereNotExists(function ($query) {
            $query->select('id')
                  ->from('model_has_roles')
                  ->whereColumn('roles.id', 'model_has_roles.role_id');
        })
        ->get();
        // dd($missingDataRoleUserForOption[0]->name);
        $pageTitle = self::$pageTitle;
        return view('user.edit', compact('user', 'userRole', 'missingDataRoleUserForOption', 'pageTitle'));
    }

    public function update(Request $req, User $user)
    {
        request()->validate(User::$rules);

        $req = $req->all();
        if (!empty($req['password'])) {
            $req['password'] = Hash::make($req['password']);
        } else {
            unset($req['password']);
        }
        $user->update($req);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($req['roles']);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        if ($id) {
            User::find($id)->delete();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')
                ->with('failed', 'User deleted failed because id is empty or null');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new UserExport, 'user.xlsx');
        return redirect()->back();
    }

    public function exportPdf()
    {
        $th = [
            'name', 
            'username',
            'email',
            'created at'
        ];
        $users = User::all();

        $html = view('pdf.table', compact('users', 'th'));
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('users.pdf');
    }

    public function profile(){
        $pageTitle = 'Profile';

        return view('user.profile', compact('pageTitle'));

    }
}

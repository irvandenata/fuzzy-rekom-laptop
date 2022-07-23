<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = User::latest()->get();

            return DataTables::of($items)
                ->addColumn('role', function ($item) {
                    return $item->role->name;
                })
                ->addColumn('action', function ($item) {
                    return $item->id != 1 || $item->role_id != 1 ? '
                           <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $item->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fas fa-pencil-alt text-white    "></i></span></a>' :
                    ' <a class="btn btn-info btn-sm" onclick="editItem(' . $item->id . ')"><i class="fas fa-pencil-alt text-white"></i></span></a>';
                })
                ->removeColumn('id')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['title'] = "Akun Pengguna";
        $data['roles'] = Role::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'role_id' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json($v->errors()->all(), 500);
        }
        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->role_id = $request->role_id;
        $item->password = Hash::make($request->password);
        $item->save();
        return response()->json(['message' => "Akun Berhasil dibuat !", "data" => $item], 200);

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
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->email != $request->email) {
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:users|max:255',
                'password' => 'required|max:255',
                'role_id' => 'required',
            ]);
        } else {
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'password' => 'required|max:255',
                'role_id' => 'required',
            ]);

        }

        if ($v->fails()) {
            return response()->json($v->errors()->all(), 500);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => "Akun Berhasil diperbaharui !", "data" => $user], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {

            $user->delete();
        return response()->json(['message' => "Akun Berhasil dihapus !"], 200);

        } catch (\Throwable $th) {
            return response()->json('Terjadi Kesalahan !', 500);
        }
    }
}

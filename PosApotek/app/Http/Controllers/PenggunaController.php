<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pengguna = User::with('roles')->get();
        $roles = Roles::all();
        return view('pengguna.index', compact('user','pengguna','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $pengguna = User::with('roles')->get();
        $roles = Roles::all();
        return view('pengguna.InputPengguna', compact('user','pengguna','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
            { $validate = $req->validate([
                'name'=> 'required',
                'email'=> 'required|unique:users',
                'password'=> 'required',
                'roles_id'=> 'required',
            ]);
    
            $user = new User;
            $user->name = $req->get('name');
            $user->email = $req->get('email');
            $user->password = Hash::make($req->get('password'));
            $user->roles_id = $req->get('roles_id');
            $user->email_verified_at = null;
            $user->remember_token = null;
            $user->save();
            Session::flash('status', 'Tambah data User berhasil!!!');
            return redirect()->route('pengguna.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $pengguna = User::where('id',$id)->with('roles')->get();
        $roles = Roles::all();
        return view('pengguna.EditPengguna', compact('user','pengguna','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
            $user= User::find($req->get('id'));
            { $validate = $req->validate([
              
                'name'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
                'roles_id'=> 'required',
            ]);
            $user->name = $req->get('name');
            $user->email = $req->get('email');
            $user->password = Hash::make($req->get('password'));
            $user->roles_id = $req->get('roles_id');
            $user->email_verified_at = null;
            $user->remember_token = null;
            $user->save();
            Session::flash('status', 'Ubah data User berhasil!!!');
            return redirect()->route('pengguna.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $success = true;
        $message = "Data Pengguna Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index',[
            'title'     => 'User Settings | SIAZAR',
            'users'     => User::orderby('role', 'asc')->get()
        ]);
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
        $validated = $request->validate([
            'name'  => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users', //untuk email jika sudah mode produksi, ubah dari 'email' menjadi 'email:dns'
            'password'  => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
            'role'      => 'required'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect('dashboard/user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit',[
            'title'     => 'User Edit | SIAZAR',
            'user'      => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'  => 'required|max:255',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }
        if($request->password != ''){
            $rules['password'] = 'required|min:8|required_with:password_confirmation|same:password_confirmation';
            // $rules['password_confirmation'] = 'required|min:8';
        }

        $validated = $request->validate($rules);

        if ($request->password != '') {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::where('id', $user->id)
            ->update($validated);

        return redirect('/dashboard/user')->with('success', 'Akun user ' . $user->name . ' berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('dashboard/user')->with('success', 'Akun user berhasil dihapus!');
    }

    // public function changeRole(Request $request){
    //     $userLogin = Auth::user()->id;
    //     if($request->id != $userLogin){
    //         if ($request->role != 'admin'){
    //             $data = ['role' => 'admin'];
    //             User::where('id', $request->id)
    //                 ->update($data);
    //         }elseif($request->role == 'admin'){
    //             $data = ['role' => 'guru'];
    //             User::where('id', $request->id)
    //                 ->update($data);
    //         }
    //     }else{
    //         return redirect('/dashboard/user')->with('error', 'Perubahan data gagal, akun user sedang login!');
    //     }
    // }

    public function GetUserRole(Request $request){
        $user = User::find($request->id);
        return response()->json($user);
    }

    public function RoleChange(Request $request){
        $userLogin = Auth::user()->id;
        if($request->id != $userLogin){
            $data = ['role'  => $request->role];
            User::where('id', $request->id)
                ->update($data);
            return redirect('/dashboard/user')->with('success', 'Role user berhasil diubah!');
        }else{
            return redirect('/dashboard/user')->with('error', 'Perubahan data gagal, akun user sedang login!');
        }
    }

}

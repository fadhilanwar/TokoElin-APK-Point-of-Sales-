<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Requests\StoreUsersRequest;
use Illuminate\Support\Facades\DB;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->where('id', '!=', auth()->user()->id)->get();
        return view('admin.master.data-user')->with([
            'title' => 'Data User',
            'datauser' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $validate = $request->validated();

        $datauser = new Users();
        $datauser->id = $request->id;
        $datauser->name = $request->name;
        $datauser->email = $request->email;
        $datauser->password = bcrypt($request->password);
        $datauser->role = $request->role;
        $datauser->save();

        alert()->success('Sukses Bro !', 'User Baru Berhasil Ditambahkan');


        return redirect('/datauser');
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $datauser, $id)
    {
        $data = $datauser->find($id);
        return view('admin.master.data-user')->with([
            'id'       => $id,
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => $data->password,
            'role'     => $data->role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, Users $datauser, $id)
    {

        $validate = $request->validated();

        $data = $datauser->find($id);
        $data->id = $request->id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->update();

        alert()->success('Sukses Bro !', 'Data Berhasil Diubah');

        return redirect('/datauser');
    }
    public function updateYours(UpdateUsersRequest $request, Users $datauser, $id)
    {
     
        $data = DB::table('users')->where('id', '=', auth()->user()->id)->get();
        $data->id = $request->id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->update();

        alert()->success('Sukses Bro !', 'Data Berhasil Diubah');


        return redirect('/yourProfile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Users::where('id', $id)->delete();
        alert()->warning('Terhapus Bro !', 'Data Berhasil Terhapus');

        return redirect('/datauser');
    }

    public function showProfile()
    {
        $users = DB::table('users')->where('id', '=', auth()->user()->id)->get();
        $title = 'Profil Akun';

          return view('admin.profile')->with([
            'datauser' => $users,
            'title' => $title
          ]);

    }
}

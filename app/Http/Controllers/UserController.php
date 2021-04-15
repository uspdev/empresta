<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::orderBy('username','asc');

        if($request->busca != null){
            $query->where('username', 'LIKE', "%$request->busca%");
            $query->orWhere('name', 'LIKE', "%$request->busca%");
        }
        $users = $query->paginate(50);
        if ($users->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('users.create')->with('user', $user);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['remember_token'] = bcrypt($validated['password']);
        $validated['password'] = Hash::make($validated['password']);
        $validated['tipo'] = 'Balcao';
        $user = User::create($validated);
        return redirect("/users/$user->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();
        $validated['remember_token'] = bcrypt($validated['password']);
        $validated['password'] = Hash::make($validated['password']);
        $user->update($validated);
        return redirect("/users/$user->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}

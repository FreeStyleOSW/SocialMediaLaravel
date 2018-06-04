<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('user_permission',['except' =>['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $posts = $user->posts()->paginate(3); niewydajne rozwiazanie 

        if (is_admin()) {
            $posts = Post::with('comments.user')
            ->with('likes')
            ->with('comments.likes')
            ->where('user_id', $id)
            ->withTrashed()
            ->paginate(3);
        }else{
            // eaeger loading - opytmalizacja zapytań do bazy
            $posts = Post::with('comments.user') 
            ->where('user_id', $id)
            ->paginate(3);
        }
        return view('users.show',compact('user','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('users.edit',compact('user'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],

        ],[
            'required' => 'Pole :attribute jest wymagane',
            'email' => 'Adres e-mail jest niepoprawny',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;

        if ($request->file('avatar')){

            $user_avatar_path = 'public/users' . $id . '/avatars';
            $upload_path = $request->file('avatar')->store($user_avatar_path);
            $avatar_filename = str_replace($user_avatar_path . '/', '', $upload_path);
            $user->avatar = $avatar_filename;
        }

        $user->save();

        return back();
    }
}

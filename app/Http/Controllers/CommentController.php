<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostCommented;




class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     function __construct()
    {
        $this->middleware('comment_permission',['except' =>['store']]);
    }


    public function store(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        $post_comment_content = 'post_'.$request->post_id.'_comment_content';
         $this->validate($request, [
            'post_'.$request->post_id.'_comment_content' => 'required|min:5',
        ],[
            'required' => 'Musisz wpisać jakąś treść',
            'min' => 'Treść musi mieć minimum :min znaków',
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->$post_comment_content,
        ]);

        if ($post->user_id != Auth::id()) {
            User::findOrFail($post->user_id)->notify(new PostCommented($comment->post_id,$comment->id));
        }

        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
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
            'comment_content' => 'required|min:5',
        ],[
            'required' => 'Musisz wpisać jakąś treść',
            'min' => 'Treść musi mieć minimum :min znaków',
        ]);

        Comment::where('id',$id)->update([
            'content' => $request->comment_content,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::where(['id' => $id])->get()->first()->delete();

        return back();
    }
}

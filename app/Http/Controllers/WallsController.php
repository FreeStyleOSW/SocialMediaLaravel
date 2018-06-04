<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;

class WallsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    } 


    function index()
    {	
    	$friends = Auth::user()->friends();
    	$friends_ids_array = [];
    	$friends_ids_array[] = Auth::id();
    	foreach ($friends as $friend) {
    		$friends_ids_array[] = $friend->id;
    	}

        if (is_admin()) {
            $posts = Post::with('comments.user')
            ->with('likes')
            ->with('comments.likes')
            ->whereIn('user_id',$friends_ids_array)
            ->OrderBy('created_at','desc ')
            ->withTrashed()
            ->paginate(5);
        }else{
    	   $posts = Post::with('comments.user')
            ->with('likes')
            ->with('comments.likes')
           ->whereIn('user_id',$friends_ids_array)
    	   ->OrderBy('created_at','desc ')
    	   ->paginate(5);
        }

    	return view('walls.index',compact('posts'));
    
    }
}

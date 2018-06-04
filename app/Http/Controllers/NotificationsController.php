<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
class NotificationsController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
	}

    function index() 
    {
    	// Auth::user()->notifications->markAsRead(); // wszystkie powiadomienia odhaczone
    	return view('notifications.index');
    }

    function update($id)
    {
    	DatabaseNotification::where([
    		'id' => $id,
    		'notifiable_id' => Auth::id(),  
    	])->firstOrFail()->markAsRead();


    	return back(); 
    }
}

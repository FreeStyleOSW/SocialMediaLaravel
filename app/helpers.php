<?php

use App\Friend;

function friendship($friend_id)
{
	$friend_query1 = Friend::where([
		'user_id' => Auth::id(),
		'friend_id' => $friend_id,
	])->first();

	$friend_query2 = Friend::where([
		'user_id' => $friend_id,
		'friend_id' => Auth::id(),
	])->first();

	$friendship = new stdClass();

	if (!is_null($friend_query1) || !is_null($friend_query2)) {
		$friendship->exists = true;

		if (!is_null($friend_query1)) {
			$friendship->accepted = $friend_query1->accepted;
		}else{
			$friendship->accepted = $friend_query2->accepted;
		}
	}else{
		$friendship->exists = false;
		$friendship->accepted = false;
	}


	return $friendship;
}

function has_friend_invitation($friend_id){

	return Friend::where([
		'user_id' => $friend_id,
		'friend_id' => Auth::id(),
		'accepted' => 0,
	])->exists();

}

function belongs_to_auth($user_id)
{
	return (Auth::check() && $user_id === Auth::id());
}

function is_admin()
{
	return (Auth::check() && Auth::user()->role->type === 'admin');
}


	

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','content'];

    protected $dates = ['deleted_at'];

    public function user()
    {
		return $this->belongsTo('App\User', 'user_id');    	
    }

    public function comments()
    {
        if (is_admin()) {
            return $this->hasMany('App\Comment')->withTrashed();
        }else{
    	   return $this->hasMany('App\Comment');
        } 
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}

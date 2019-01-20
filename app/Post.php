<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Post extends Model
{


    use SoftDeletes;
 
    protected $fillable = [
        'title', 'content', 'category_id', 'featrued','slug' ,'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function getFeatruedAttribute($featrued)
    {
        return asset($featrued);
    }



    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


}

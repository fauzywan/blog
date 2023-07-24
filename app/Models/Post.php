<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['title','user_id','editor_id','thumbnail','content','status','comment','permalink'];
    
    public function categories()
    {
        return $this->belongsToMany(Category::class,'post_categories','post_id','category_id');
        
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function writter()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function editor()
    {
        return $this->belongsTo(User::class,'editor_id','id');
    }
}

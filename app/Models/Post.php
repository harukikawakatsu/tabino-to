<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
   
    public function getByLimit(int $limit_count = 10)
            {
                // updated_atで降順に並べたあと、limitで件数制限をかける
                return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
            }    
        
        
    
    public function getPaginateByLimit(int $limit_count = 5)
        {
            return $this::with('user')->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
        
    // 他のモデルとの関連を定義する
    public function user()
        {
            return $this->belongsTo(User::class);
        }
        
    public function category()
        {
            return $this->belongsTo(Category::class);
        }
        
    public function location()
        {
            return $this->belongsTo(Location::class);
        }
        
    public function sub_photos()
        {
            return $this->hasMany(Sub_photo::class);
        }
        
    public function likes()
        {
            return $this->hasMany(Like::class);
        }
        
    public function comments()
        {
            return $this->hasMany(Comment::class);
        }
    protected $fillable = [
    'comment',
    'image_url',
    'user_id',
    'category_id'
];
}

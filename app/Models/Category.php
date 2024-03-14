<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    
    public function getByCategory(int $limit_count = 5)
        {
             return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        }
        
    //「1対多」の関係なので'posts'と複数形に
    public function posts()   
        {
            return $this->hasMany(Post::class);  
        }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    protected $table = 'locations';
    
    //「1対多」の関係なので'posts'と複数形に
    public function posts()   
        {
            return $this->hasMany(Post::class);  
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['name'] ?? false, function($query, $name){
            return $query->where('name','like','%'.$name.'%');
        });
    }
}

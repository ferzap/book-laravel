<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['title'] ?? false, function($query, $title){
            return $query->where('title','like','%'.$title.'%');
        });
        
        $query->when($filters['description'] ?? false, function($query, $description){
            return $query->where('description','like','%'.$description.'%');
        });

        if($filters['category'] ?? false){
            $categories = explode(', ', $filters['category']);
            $find_category_id = Category::whereIn('name', $categories)->pluck('id')->toArray();
            foreach ($find_category_id as $key => $value) {
                $find_category_id[$key] = (string)$value;
            }
            $query->when($find_category_id ?? false, function($query, $category){
                return $query->whereJsonContains('category_id', $category);
            });
        }

        $query->when($filters['keywords'] ?? false, function($query, $keywords){
            $keywords = explode(', ', $keywords);
            return $query->whereJsonContains('keywords', $keywords);
        });
        $query->when($filters['price'] ?? false, function($query, $price){
            return $query->where('price','=', $price);
        });
        $query->when($filters['publisher'] ?? false, function($query, $author){
            return $query->where('publisher','like','%'.$author.'%');
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

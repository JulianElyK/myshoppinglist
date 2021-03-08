<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppinglist extends Model
{
    use HasFactory;
    
    protected $table = 'shoppinglists';
    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'date'
    ];
    
    protected $date = [
        'created_at',
        'updated_at'
    ];

    public function shoppinglistdetails(){
        return $this->hasMany(ShoppingListDetail::class);
    }
}

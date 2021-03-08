<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppinglistdetail extends Model
{
    use HasFactory;

    protected $table = 'shoppinglistdetails';

    protected $fillable = [
        'shoppinglist_id',
        'number',
        'itemname',
        'amount',
        'unit',
        'memo'
    ];
    
    protected $date = [
        'created_at',
        'updated_at'
    ];

    public function shoppinglist(){
        return $this->belongsTo(Shoppinglist::class);
    }
}

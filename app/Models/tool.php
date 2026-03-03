<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tool extends Model
{
use SoftDeletes;
    //
protected $fillable = [
        'category_id',
        'name_tools',
        'stock',
        'price'
    ];

// in tool cls
public function category() {
    return $this->belongsTo(category::class);
}

    //  hasMany to loan
public function loans() 
{
    return $this->hasMany(loan::class);
}

}



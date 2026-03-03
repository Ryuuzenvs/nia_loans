<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = [
    'nama_kategori'   
    ];

// in cat cls
public function tools() {
    return $this->hasMany(tool::class);

}
}



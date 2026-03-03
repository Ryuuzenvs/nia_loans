<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class loan extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
    'borrower_id',   
    'tool_id',
    'approved_by',   
    'loan_date',
    'penalty',
    'return_date',
    'status',
'qty',
'due_date',
    'request_return_date'
];

// Relasi to borrower
public function borrower() {
    return $this->belongsTo(User::class, 'borrower_id'); 
}

public function approver() {
    return $this->belongsTo(User::class, 'approved_by'); 
}

public function tool() {
    return $this->belongsTo(tool::class, 'tool_id');
}
}

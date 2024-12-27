<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'order_id',
        'priority',
        'priority_so',
        'created_at',
    ];
    public $timestamps = false;
}

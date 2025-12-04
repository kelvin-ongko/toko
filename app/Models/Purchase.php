<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'admin_id', 'total', 'grandtotal', 'discount', 'items', 'status', 'date'];
}

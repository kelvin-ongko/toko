<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'customer_id', "customer", 'admin_id', 'total', 'grandtotal', 'discount', 'totalcapitalprice', 'items', 'status', 'date'];
}

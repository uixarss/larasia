<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table = 'bills';

    protected $fillable = [
        'bill_number',
        'order_number',
        'bill_status_code',
        'billed_at',
        'due_at',
        'amount',
        'vendor_name',
        'vendor_email',
        'vendor_tax_number',
        'vendor_phone',
        'vendor_address',
        'notes',
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    //
    protected $table = 'virtual_account';
    protected $fillable = [
            'id',
            'client_id',
            'trx_id', // fill with Billing ID
            'trx_amount',
            'billing_type',
            'datetime_expired', // billing will be expired in 2 hours
            'virtual_account',
            'customer_name',
            'customer_email',
            'customer_phone',
            'type',
            'updated_at',
            'created_at'
    ];
}

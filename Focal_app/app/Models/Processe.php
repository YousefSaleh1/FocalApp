<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processe extends Model
{
    use HasFactory;
    protected $fillable = [
        'walet_id',
        'contact_number',
        'amount',
        'sender_name',
        'sender_id_number',
        'payment_method',
        'receipt_number',
        'address',
        'receiver_name',
        'receiver_id_number',
        'password_vorifi'
    ];
    public function walet()
    {
        return $this->belongsTo(Walets::class, 'walet_id', 'id');
    }
}

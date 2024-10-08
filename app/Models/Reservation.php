<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'date', 'time', 'seats', 'special_requests','table_id'
    ];
    
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}

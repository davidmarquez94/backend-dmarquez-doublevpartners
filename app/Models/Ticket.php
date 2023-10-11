<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    //Definiendo campos del modelo
    protected $fillable = [
        'username',
        'description',
        'status'
    ];

    //Filtrar tickets por id
    public function scopeId($query, $id) {
        if($id) {
            return $query->where('id', 'like', '%' . $id . '%');
        }
    }

    //Filtrar tickets por status
    public function scopeStatus($query, $status) {
        $allowed_status = ['open', 'closed'];
        if(in_array($status, $allowed_status)) {
            return $query->where('status', '=', $status);
        }
    }
}

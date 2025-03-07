<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ["id"];

    public function pesanans() {
        return $this->hasMany(Pesanan::class);
    }
}

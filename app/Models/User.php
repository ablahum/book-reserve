<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ["id"];
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
}

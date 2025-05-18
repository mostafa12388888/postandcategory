<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['facebook','site_name','logo','favicon','instagram','twitter','youtube','street','city','country','email','phone'];
}

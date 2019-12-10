<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcomes extends Model
{
    
    protected $table = 'outcomes';
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'assets', 'o_accounts', 'total', 'info', 'created_at', 'updated_at'];
}

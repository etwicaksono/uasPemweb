<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'assets', 'i_accounts', 'total', 'info', 'created_at', 'updated_at'];
}

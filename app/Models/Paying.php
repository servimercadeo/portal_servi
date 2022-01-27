<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paying extends Model
{
    use HasFactory;

    protected $table = 'payings2';

    protected $fillable = ['_link','operation', 'tipo', 'id_pais'];

    public function pais(){
        return $this->belongsTo('App\Models\Pais','id_pais','id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class column extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = ['sheet_id', 'index'];

    public function cells()
    {
        return $this->hasMany(cell::class);
    }

    public function headers()
    {
        return $this->hasMany(header::class);
    }
}

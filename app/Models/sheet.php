<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'uuid';
    protected $table = 'sheet';
    protected $fillable = ['name'];

    public function rows()
    {
        return $this->hasMany(row::class);
    }

    public function columns()
    {
        return $this->hasMany(column::class);
    }
}

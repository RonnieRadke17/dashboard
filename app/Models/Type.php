<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    use HasFactory;

    protected $fillable = ['typename'];

    public function devices()
    {
        return $this->hasMany(Device::class, 'types_id');
    }
}

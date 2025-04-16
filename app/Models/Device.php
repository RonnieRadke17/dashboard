<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'devicename',
        'device_model',
        'is_active',
        'ip',
        'latitude',
        'longitude',
        'baterylevel',
        'user_agent',
        'user_id',
        'types_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class UuidModel extends Model
{
    protected $casts = ['id' => 'string'];
    protected $guarded = ['id'];

    public $incrementing = false;
    public $keyType = 'string';

    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {

            $model->id = Str::uuid()->toString();
            
        });
    }
}

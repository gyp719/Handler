<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;

    const TYPE_RANDOM  = 'random';
    const TYPE_APPOINT = 'appoint';

    public static array $typeMap = [
        self::TYPE_RANDOM  => '随机',
        self::TYPE_APPOINT => '指定',
    ];
}

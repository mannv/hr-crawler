<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Company.
 *
 * @package namespace App\Entities;
 */
class Company extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'companies';

    protected $fillable = [
        'is_crawler',
        'source',
        'base_url',
        'name',
        'member_scale',
        'country',
        'location',
        'address',
        'phone_number',
        'founding_date'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'reports';

    /**
     * @var array
     */
    protected $fillable = [
        'from_id',
        'to_id',
        'value'
    ];
}

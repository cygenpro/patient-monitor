<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'records';

    /**
     * @var array
     */
    protected $fillable = [
        'from_id',
        'to_id',
        'temperature',
        'has_cough',
        'has_hard_breath',
        'has_sore_throat',
        'has_diarrhea',
        'has_tiredness'
    ];

    /**
     * @param $date
     * @return false|string
     */
    public function getCreatedAtAttribute($date)
    {
        return date('m/d/Y H:i', strtotime($date));
    }

    /**
     * @param $date
     * @return false|string
     */
    public function getUpdatedAtAttribute($date)
    {
        return date('m/d/Y H:i', strtotime($date));
    }

    public function getTemperatureAttribute($value)
    {
        return decrypt($value);
    }

    public function getHasCoughAttribute($value)
    {
        return decrypt($value);
    }

    public function getHasHardBreathAttribute($value)
    {
        return decrypt($value);
    }

    public function getHasSoreThroatAttribute($value)
    {
        return decrypt($value);
    }

    public function getHasDiarrheaAttribute($value)
    {
        return decrypt($value);
    }

    public function getHasTirednessAttribute($value)
    {
        return decrypt($value);
    }
}

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
        'has_tiredness',
        'seen_at'
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

    /**
     * @param $value
     * @return mixed
     */
    public function getTemperatureAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHasCoughAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHasHardBreathAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHasSoreThroatAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHasDiarrheaAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHasTirednessAttribute($value)
    {
        return decrypt($value);
    }
}

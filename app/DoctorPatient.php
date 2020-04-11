<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorPatient extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'doctor_patient';

    /**
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'patient_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'id', 'doctor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public  function patient()
    {
        return $this->belongsTo(User::class, 'id', 'patient_id');
    }
}

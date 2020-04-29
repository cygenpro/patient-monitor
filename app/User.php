<?php

namespace App;

use App\Services\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'phone_verified_at', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        return $this->hasMany(DoctorPatient::class, 'doctor_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany(DoctorPatient::class, 'patient_id', 'id');
    }

    /**
     * @return bool
     */
    public function isDoctor(): bool
    {
        return $this->role_id == Role::DOCTOR_ID;
    }

    /**
     * @param int $patientId
     * @return bool
     */
    public function hasPatient( int $patientId ): bool
    {
        return $this->patients()->where('patient_id', $patientId)->exists();
    }

    public function getNameAttribute($value)
    {
        return decrypt($value);
    }
}

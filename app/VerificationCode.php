<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'verification_codes';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCodeAttribute($value)
    {
        return decrypt($value);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    /**
     * @var string
     */
    protected $table = 'report_types';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}

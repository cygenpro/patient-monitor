<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
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
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}

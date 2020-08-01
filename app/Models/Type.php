<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Type
 * @package App\Models
 */
class Type extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'types';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'url',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function situations()
    {
        return $this->hasMany(Situation::class);
    }
}

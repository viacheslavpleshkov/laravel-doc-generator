<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Situation
 * @package App\Models
 */
class Situation extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'situations';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'url',
        'type_id',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

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
        'description',
        'type_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentfile()
    {
        return $this->hasMany(DocumentFile::class, 'situation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userfillinput()
    {
        return $this->hasMany(User_fillInput::class, 'situation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'situation_id');
    }
}

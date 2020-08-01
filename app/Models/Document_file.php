<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document_file
 * @package App\Models
 */
class Document_file extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'documents_files';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'situation_id',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document()
    {
        return $this->hasMany(Order::class);
    }
}

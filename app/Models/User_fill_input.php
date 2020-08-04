<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User_fill_input
 * @package App\Models
 */
class User_fill_input extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'user_fill_input';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'user_input',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}

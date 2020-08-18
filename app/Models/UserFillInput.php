<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User_fillInput
 * @package App\Models
 */
class UserFillInput extends Model
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
        'type_id',
        'situation_id',
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
    public function situation()
    {
        return $this->belongsTo(Situation::class, 'situation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document()
    {
        return $this->belongsTo(DocumentKey::class, 'document_id');
    }
}

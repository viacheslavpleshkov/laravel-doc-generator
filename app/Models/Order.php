<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'orders';
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'document_file_id',
        'transaction',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document_file()
    {
        return $this->belongsTo(DocumentFile::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentKey
 * @package App\Models
 */
class DocumentKey extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'documents_keys';
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'key',
        'document_file_id'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentfile()
    {
        return $this->belongsTo(DocumentFile::class, 'document_file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userfillinput()
    {
        return $this->hasMany(User_fill_input::class, 'document_id');
    }
}

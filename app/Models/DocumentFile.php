<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentFile
 * @package App\Models
 */
class DocumentFile extends Model
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
        'title',
        'file_path',
        'price',
        'situation_id',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(DocumentKey::class, 'document_file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situation()
    {
        return $this->belongsTo(Situation::class, 'situation_id');
    }

}

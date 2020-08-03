<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\Models
 */
class Document extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'documents';
    /**
     * @var string[]
     */
    protected $fillable = [
        'document_file_id',
        'title',
        'key',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document_file()
    {
        return $this->hasMany(Document_file::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_fill_input()
    {
        return $this->hasMany(User_fill_input::class);
    }
}

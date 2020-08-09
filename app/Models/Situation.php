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
        'price',
        'type_id',
        'document_file_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

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
        return $this->hasMany(User_fill_input::class, 'situation_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**]
 * Class News
 * @package App\Models
 */
class News extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'news';
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'text',
        'url',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

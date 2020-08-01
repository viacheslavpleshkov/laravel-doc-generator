<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 */
class Setting extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * @var string
     */
    protected $table = 'settings';
    /**
     * @var string[]
     */
    protected $fillable = [
        'paginate_admin',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

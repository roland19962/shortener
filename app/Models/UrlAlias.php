<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlAlias extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url_aliases';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'hash';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'hash',
        'url'
    ];

}

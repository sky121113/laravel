<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstConhi extends Model
{
    use SoftDeletes;
    // 資料表名稱與class不一樣的話 就要加上
    // protected $table = 'table_name';
    protected $table = 'mama_hello';

    protected $primaryKey = 'id';
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';
    const DELETED_AT = 'deleted_date';
}
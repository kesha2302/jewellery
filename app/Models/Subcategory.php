<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'subcategory';
    protected $primaryKey = 'subcategory_id';

    protected $fillable = [
        'category_id',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

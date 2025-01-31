<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['category'];

    public function faqQuestions()
    {
        return $this->hasMany(FaqQuestion::class, 'category_id');
    }
}

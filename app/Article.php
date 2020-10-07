<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ArticleContent;
class Article extends Model
{
    protected $fillable = [
        'hot_content'
    ];
    public function contents(){
        return $this->hasMany(ArticleContent::class);
    }
}

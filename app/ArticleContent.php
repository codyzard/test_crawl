<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
class ArticleContent extends Model
{
    protected $fillable = [
        'sub_content'
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}

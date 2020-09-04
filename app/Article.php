<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ArticleContent;
class Article extends Model
{
    public function contents(){
        return $this->hasMany(ArticleContent::class);
    }
}

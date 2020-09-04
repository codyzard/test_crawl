<?php

namespace App\Scraper;

use App\Article;
use App\ArticleContent;
use App\Product;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class TGDD
{

    public function scrape()
    {
        $url = 'https://thethao247.vn/bong-da-anh-c8/';

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $crawler->filter('ul.playlist_hl_video li')->each(
            function (Crawler $node) {
                $title = $node->filter('h3 a')->text();
                $hot_content = $node->filter('p')->text();
                $sub_url = $node->filter('h3 a')->attr('href');
                $article = new Article;
                $article->title = $title;
                $article->hot_content = $hot_content;
                $article->save();

                $sub_client = new Client();
                $sub_req = $sub_client->request('GET', $sub_url);
                $sub_req->filter('#main-detail p')->each(
                    function(Crawler $node){
                        $article = Article::all()->last();
                        $sub_content = $node->text();
                        $article->contents()->create(['sub_content' => $sub_content]);
                    }
                );


            });
    }
}

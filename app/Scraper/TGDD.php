<?php

namespace App\Scraper;

use App\Article;
use App\ArticleContent;
use App\Product;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
class TGDD
{

    private $main_url = 'https://thethao247.vn/';
    private $service_url = '127.0.0.1:5000';
    public function scrape()
    {
        // $url = 'https://thethao247.vn/bong-da-anh-c8/';
        // $url = 'https://thethao247.vn/333-dembele-dong-y-den-mu-voi-dieu-kien-duoc-cat-dut-quan-he-voi-barca-d214614.html';
        // $client = new Client();

        // $crawler = $client->request('GET', $url);
        // $crawler->filter('#main-detail p')->each(
        //     function(Crawler $node){
        //         $url_service  = '127.0.0.1:5000';

        //         if($node->children()->count() == 0)
        //         {
        //             $content = $node->text().PHP_EOL;
        //             $request_servce = Http::post($url_service.'/check', ['content' => $content]);
        //             $article = new Article;
        //             $article->hot_content = $request_servce->body();
        //             $article->save();
        //             echo $request_servce->body();
        //         }
        //     }
        // );
        // $crawler->filter('ul.playlist_hl_video li')->each(
        //     function (Crawler $node) {
        //         $title = $node->filter('h3 a')->text();
        //         $hot_content = $node->filter('p')->text();
        //         $sub_url = $node->filter('h3 a')->attr('href');
        //         $article = new Article;
        //         $article->title = $title;
        //         $article->hot_content = $hot_content;
        //         $article->save();
        //         $GLOBALS['content'] = '';
        //         $sub_client = new Client();
        //         $sub_req = $sub_client->request('GET', $sub_url);
        //         $sub_req->filter('#main-detail p')->each(
        //             function(Crawler $node){
        //                 $article = Article::all()->last();
        //                 $sub_content = $node->text();
        //                 $article->contents()->create(['sub_content' => $sub_content]);
        //                 $GLOBALS['content'] .= "<br>".$node->text()."</br>";
        //             }
        //         );
        //         $url_service  = '127.0.0.1:5000';
        //         $request_servce = Http::post($url_service.'/check', ['content' => $GLOBALS['content']]);
        //         echo $request_servce->body();

        //     });

        // $this->common_sport_crawler();
        $this->soccer_crawler();
    }

    public function common_sport_crawler(){
        $client = new Client();

        $crawler = $client->request('GET', $this->main_url);

        $crawler->filter('#cate-5 a')->each(
            function(Crawler $node){
                $href = $node->attr('href');

                $each_client = new Client();

                $each_crawler = $each_client->request('GET', $this->main_url);

                $each_crawler->filter('ul.list_newest li')->each(
                    function(Crawler $node){
                        $main_img = $node->filter('img')->attr('src');
                        $detail_href = $node->filter('h3 a')->attr('href');
                        $detail_client = new Client();
                        $detail_crawler = $detail_client->request('GET', $detail_href);

                        $title = $detail_crawler->filter('div.colcontent h1')->text();
                        $request_servce = Http::post($this->service_url.'/check', ['content' => $title]);
                        echo $request_servce->body();
                        // $hot_content = $detail_crawler->filter('div.colcontent p.typo_news_detail')->text();

                        // $content = $detail_crawler->filter('#main-detail p')->each(function (Crawler $node) {
                        //     if($node) return '<br>'.$node->text().'</br>';
                        // });
                    }
                );
            }
        );
    }
    public function soccer_crawler(){
        $client = new Client();

        $crawler = $client->request('GET', $this->main_url);

        $crawler->filter('#cate-2 a')->each(
            function (Crawler $node) {
                $href = $node->attr('href');

                $each_client = new Client();

                $each_crawler = $each_client->request('GET', $href);

                $each_crawler->filter('ul.list_newest li')->each(
                    function(Crawler $node){
                        $main_img = $node->filter('img')->attr('src');
                        $detail_href = $node->filter('h3 a')->attr('href');
                        $detail_client = new Client();
                        $detail_crawler = $detail_client->request('GET', $detail_href);

                        $title = $detail_crawler->filter('div.colcontent h1')->text();

                        $request_servce = Http::post($this->service_url.'/check', ['content' => $title]);

                        $hot_content = $detail_crawler->filter('div.colcontent p.typo_news_detail')->text();
                        echo $request_servce->body();
                        // $content = $detail_crawler->filter('#main-detail p')->each(function (Crawler $node) {
                        //     if($node) return '<br>'.$node->text().'</br>';
                        // });
                        // $content = implode(' ', $content);
                        // $article = new Article;
                        // $article->title = $title;
                        // $article->hot_content = $hot_content;
                        // $article->content = $content;
                        // $article->save();

                    }
                );

            });
    }

    public function esport_crawler(){
        $client = new Client();

        $crawler = $client->request('GET', $this->main_url);

        $crawler->filter('#cate-180 a')->each(
            function (Crawler $node) {
                $href = $node->attr('href');

                $each_client = new Client();

                $each_crawler = $each_client->request('GET', $href);

                $each_crawler->filter('ul.list_newest li')->each(
                    function(Crawler $node){
                        $main_img = $node->filter('img')->attr('src');
                        $detail_href = $node->filter('h3 a')->attr('href');
                        $detail_client = new Client();
                        $detail_crawler = $detail_client->request('GET', $detail_href);

                        $title = $detail_crawler->filter('div.colcontent h1')->text();

                        $request_servce = Http::post($this->service_url.'/check', ['content' => $title]);

                        $hot_content = $detail_crawler->filter('div.colcontent p.typo_news_detail')->text();

                        // $content = $detail_crawler->filter('#main-detail p')->each(function (Crawler $node) {
                        //     if($node) return '<br>'.$node->text().'</br>';
                        // });
                        // $content = implode(' ', $content);
                        // $article = new Article;
                        // $article->title = $title;
                        // $article->hot_content = $hot_content;
                        // $article->content = $content;
                        // $article->save();

                    }
                );

            });
    }
}

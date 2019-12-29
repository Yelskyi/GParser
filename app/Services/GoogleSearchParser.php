<?php
namespace App\Services;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class GoogleSearchParser {

    public function getPosition($domain, $keyword)
    {
        $url = 'http://google.com/search?q='.$keyword.'&num=100';
        $client = new Client();

        $crawler = $client->request('GET', $url);

        //Не работает
        /*$proxylist = [
            '122.201.112.114:80',
            '101.50.1.2:80',
            '138.201.72.117:80',
        ];
        $iter=0;
        $error=false;
        do{
            try
            {
                $client->setClient(new GuzzleClient([
                    'proxy' => $proxylist[$iter],
                ]));
                $crawler = $client->request('GET', $url);
                $elements = $crawler->filter('.BNeawe.UPmit.AP7Wnd')->each(function(Crawler $node){
                    return $node->text();
                });
                if(count($elements)==0)
                {
                    $iter++;
                    continue;
                }
                break;
            }
            catch (\Exception $e)
            {
                $error=true;
            }
            $iter++;
        }while($iter<count($proxylist)&&$error==true);
        if($iter==count($proxylist))
        {
            return "Here is no proxy available";
        }
        $elements = $crawler->filter('.BNeawe.UPmit.AP7Wnd')->each(function(Crawler $node){
            return $node->text();
        });
        */

        $elements = $crawler->filter('.BNeawe.UPmit.AP7Wnd')->each(function(Crawler $node){
            return $node->text();
        });
        $position=1;
        foreach ($elements as $element)
        {
            $host = parse_url($element);
            try
            {
                $host = $host['host'];
            }
            catch (\Exception $e)
            {
                $position++;
                continue;
            }
            $host = explode(' ', $host);
            if($host[0] == $domain)
            {
                dump("Success");
                break;
            }
            $position++;
        }
        if($position>=count($elements))
        {
            $position="Not found";
        }
        dump($position);
        return $position;
    }
}
<?php
namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class GoogleSearchParser {

    public function getPosition($domain, $keyword)
    {
        $url = 'https://google.com/search?q='.$keyword.'&num=100';
        //Рабочий вариант, но не для гугла
        $proxylist = [
            '51.158.108.135:8811',
            '167.172.35.224:8080',
            '51.158.113.142:8811',
            '51.158.68.68:8811',
            '104.244.75.26:8080',
            '51.91.212.159:3128',
            '51.158.98.121:3128',
            '51.158.108.135:8811',
            '104.244.77.254:8080'
        ];


        $iter=0;
        $elements=null;
        $error=false;
        do{
            try
            {
                $context = stream_context_create([
                    'http' => [
                        'proxy' => $proxylist[$iter],
                        'request_fulluri' => false
                                ]
                ]);
                $res = file_get_contents($url, false, $context);

                $crawler = new Crawler($res);

                $elements = $crawler->filter('.BNeawe.UPmit.AP7Wnd')->each(function(Crawler $node){
                    return $node->text();
                });
                //Игнор капчи
                if(count($elements)==0)
                {
                    $iter++;
                    continue;
                }
                break;
            }
            catch (\Exception $e)
            {
                dump("unsuccessfully");
                $error=true;
            }
            $iter++;
        }while($iter<count($proxylist)&&$error==true);
        if($iter==count($proxylist))
        {
            return "Here is no proxy available";
        }

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
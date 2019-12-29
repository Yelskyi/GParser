<?php

namespace App\Http\Controllers;

use App\Gsearch;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\GoogleSearchParser;


class Controller extends BaseController
{
    public function gsearch()
    {
        return view('searchform');
    }
    public function result()
    {
        $result = DB::select('SELECT * 
                                    FROM gsearches');
        return view('result', [
            'result' => $result
        ]);
    }
    public function tosearch()
    {
        $params = null;
        if(request(['domain']))
        {
            $GoogleSearchParser = new GoogleSearchParser();
            $result=$GoogleSearchParser->getPosition(request('domain'), request('key'));
            $params = [
                'domain' => request('domain'),
                'key' => request('key'),
                'position' => $result
            ];
            DB::insert('insert into gsearches (domainname, keyword, position) value (?, ?, ?)', [
                request('domain'),
                request('key'),
                $result,
            ]);

        }

        return view('searchform', $params);
    }
}

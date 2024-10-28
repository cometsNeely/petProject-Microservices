<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Show;
use Illuminate\Support\Facades\Redis;
use App\Events\ShowsDoneEvent;
use Illuminate\Support\Str;

//use App\Http\Resources\Show\ShowResource;


class IviService {

    public function callIviParse($path) {

        $zeroPage = null;

            for($i = 1; $i <= 3; $i ++) {

                if ($i === 1) {
                    $response = Http::get('https://www.ivi.ru/movies'.$path);
                }
                else {
                    $response = Http::get('https://www.ivi.ru/movies'.$path.'/page'.$i);
                }

                if($response && $response->status() === 200) {

                    preg_match_all('/<span class="nbl-slimPosterBlock__titleText">(.*?)<\/span>/', $response, $match);

                    if($i === 1) {
                        $zeroPage = $match[1];
                    }

                    // Если пытаемся получить доступ к undefined странице
                    if ($i > 1 && $zeroPage == $match[1]) {
                        break;
                    }

                    foreach($match[1] as $result) {

                        $keys = Redis::keys("*");

                        $flag = false;

                        if(count($keys) === 0) {

                            Redis::set(preg_replace('/[^A-Za-z0-9\-]/', '', $path).$result, $result);
                            ShowsDoneEvent::dispatch(preg_replace('/[^A-Za-z0-9\-]/', '', $path), $result);
                            
                        }

                        foreach ($keys as $key) {

                            $res = Str::contains($key, preg_replace('/[^A-Za-z0-9\-]/', '', $path).$result);

                            if ($res === false) {

                                $flag = true;
                                
                            }

                        }

                        if($flag===true) {
                            $flag=false;
                            Redis::set(preg_replace('/[^A-Za-z0-9\-]/', '', $path).$result, $result);
                            ShowsDoneEvent::dispatch(preg_replace('/[^A-Za-z0-9\-]/', '', $path), $result);
                        }

                    } 
                }
            }
        }
}
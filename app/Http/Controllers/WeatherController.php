<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTable()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET', 'https://tinyurl.com/y7y54gms');
        $data = json_decode($result->getBody());

        $tittle = $data->records->datasetDescription;
        $info_list = $data->records->location;
        $weathers = [];
        foreach ($info_list as $key => $list) {
            $weathers[$key]['locationName'] = $list->locationName;
            $weathers[$key]['startTime'] = $list->weatherElement[0]->time[0]->startTime;
            $weathers[$key]['endTime'] = $list->weatherElement[0]->time[0]->endTime;
            $weathers[$key]['status'] = $list->weatherElement[0]->time[0]->parameter->parameterName;
            $cc_low = $list->weatherElement[2]->time[0]->parameter;
            $cc_high = $list->weatherElement[4]->time[0]->parameter;
            $weathers[$key]['temp_low'] = $cc_low->parameterName .'°'.$cc_low->parameterUnit;
            $weathers[$key]['temp_high'] = $cc_high->parameterName .'°'.$cc_high->parameterUnit;
            $weathers[$key]['feeling'] = $list->weatherElement[3]->time[0]->parameter->parameterName;
        }
        $data=[];
        $data['tittle'] = $tittle;
        $data['list'] = $weathers;
        return view('home', $data);
    }
}

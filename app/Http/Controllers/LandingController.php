<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Screen;

class LandingController extends Controller
{
    public function index()
    {

        $data['banner'] = Config::where('config_key', 'landing')->where('config_value', 'banner')->first()->files->first()->link;
        $data['logo'] = Config::where('config_key', 'landing')->where('config_value', 'logo')->first()->files->first()->link;
        $data['background_header'] = Config::where('config_key', 'landing')->where('config_value', 'background_header')->first()->files->first()->link;
        $data['word_event'] = Config::where('config_key', 'landing')->where('config_value', 'word_event')->first();
        $data['highlight_event'] = Config::where('config_key', 'highlight_event')->first();
        $data['screen'] = Screen::where('status', 1)->first();
        $data['event'] = $data['screen']->events;
        $data['leader'] = Screen::orderBy('year', 'ASC')->get();
        $data['sponsor'] = Config::where('config_key', 'sponsor')->get();
        $data['mediapartner'] = Config::where('config_key', 'mediapartner')->get();
        $data['transparant_color'] = Config::where('config_key', 'transparant_color')->first()->config_value;
        $data['phone'] = Config::where('config_key', 'phone_number')->first()->config_value;
        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['address'] = Config::where('config_key', 'address')->first()->config_value;
        $data['email'] = Config::where('config_key', 'email')->first()->config_value;
        $data['location'] = Config::where('config_key', 'location')->first()->config_value;

        $data['social_media'] = Config::where('config_key', 'social_media')->get();

        return view('landing', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Log;
use App\Models\Screen;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        Log::record(Auth::user(), 'accessing landing page ', 'this is extra log');

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

        //color
        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['dark_color'] = Config::where('config_key', 'dark_color')->first()->config_value;
        $data['background_color'] = Config::where('config_key', 'background_color')->first()->config_value;
        $data['font_color'] = Config::where('config_key', 'font_color')->first()->config_value;

        //sosmed
        $data['address'] = Config::where('config_key', 'address')->first()->config_value;
        $data['email'] = Config::where('config_key', 'email')->first()->config_value;
        $data['location'] = Config::where('config_key', 'location')->first()->config_value;

        $data['social_media'] = Config::where('config_key', 'social_media')->get();
        $data['registration'] = Screen::where('status', 1)->first()->events;
        return view('landing', $data);
    }
}

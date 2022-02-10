<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\FormResult;
use App\Models\Log;
use App\Models\Screen;
use App\Models\Subevent;
use App\Models\User;
use App\Notifications\FormsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Str;

class SubeventController extends Controller
{
    public function index($slug)
    {

        Log::record(Auth::user(), 'accessing Halaman ' . $slug, 'this is extra log');
        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['dark_color'] = Config::where('config_key', 'dark_color')->first()->config_value;
        $data['background_color'] = Config::where('config_key', 'background_color')->first()->config_value;
        $data['font_color'] = Config::where('config_key', 'font_color')->first()->config_value;

        $data['logo'] = Config::where('config_key', 'landing')->where('config_value', 'logo')->first()->files->first()->link;
        $data['background_header'] = Config::where('config_key', 'landing')->where('config_value', 'background_header')->first()->files->first()->link;
        $data['word_event'] = Config::where('config_key', 'landing')->where('config_value', 'word_event')->first();
        $data['highlight_event'] = Config::where('config_key', 'highlight_event')->first();
        $data['transparant_color'] = Config::where('config_key', 'transparant_color')->first()->config_value;
        $data['phone'] = Config::where('config_key', 'phone_number')->first()->config_value;
        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['dark_color'] = Config::where('config_key', 'dark_color')->first()->config_value;
        $data['address'] = Config::where('config_key', 'address')->first()->config_value;
        $data['email'] = Config::where('config_key', 'email')->first()->config_value;
        $data['location'] = Config::where('config_key', 'location')->first()->config_value;
        $data['social_media'] = Config::where('config_key', 'social_media')->get();
        $data['registration'] = Screen::where('status', 1)->first()->events;
        $data['subevent'] = Subevent::where('slug', $slug)->first();
        $data['title'] = $data['subevent']->name;
        if ($data['subevent']->status != 1) {
            return redirect('/');
        }

        return view('front.subevent', $data);
    }
    public function form($slug)
    {
        Log::record(Auth::user(), 'accessing Halaman Form ' . $slug, 'this is extra log');

        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['dark_color'] = Config::where('config_key', 'dark_color')->first()->config_value;
        $data['background_color'] = Config::where('config_key', 'background_color')->first()->config_value;
        $data['font_color'] = Config::where('config_key', 'font_color')->first()->config_value;
        $data['background_header'] = Config::where('config_key', 'landing')->where('config_value', 'background_header')->first()->files->first()->link;

        $data['logo'] = Config::where('config_key', 'landing')->where('config_value', 'logo')->first()->files->first()->link;

        $data['word_event'] = Config::where('config_key', 'landing')->where('config_value', 'word_event')->first();
        $data['highlight_event'] = Config::where('config_key', 'highlight_event')->first();
        $data['transparant_color'] = Config::where('config_key', 'transparant_color')->first()->config_value;
        $data['phone'] = Config::where('config_key', 'phone_number')->first()->config_value;
        $data['primary_color'] = Config::where('config_key', 'primary_color')->first()->config_value;
        $data['dark_color'] = Config::where('config_key', 'dark_color')->first()->config_value;
        $data['address'] = Config::where('config_key', 'address')->first()->config_value;
        $data['email'] = Config::where('config_key', 'email')->first()->config_value;
        $data['location'] = Config::where('config_key', 'location')->first()->config_value;
        $data['social_media'] = Config::where('config_key', 'social_media')->get();
        $data['registration'] = Screen::where('status', 1)->first()->events;
        $data['subevent'] = Subevent::where('slug', $slug)->first();
        $data['form'] = Subevent::where('slug', $slug)->first()->forms;
        $data['title'] = $data['subevent']->name;
        if ($data['subevent']->status != 1) {
            return redirect('/');
        }
        return view('front.form', $data);
    }
    public function saveform(Request $request, $slug)
    {
        Log::record(Auth::user(), 'Mengisi Form ' . $slug, 'this is extra log');
        $subevent = Subevent::where('slug', $slug)->first();
        $identity = date("Y-m-d");
        $random = Str::random(6);
        $iden = null;
        // dd($request);
        foreach ($request->request as $key => $value) {
            $file = 0;
            if ($key == '_token') {
                continue;
            }
            if (count($value) < 3) {

                $name_picture = Str::random(6) . '.png';
                $item = new FormResult();
                $item->form_id = $value[0];
                $item->value = $name_picture;
                $item->type = $value[1];
                $namePath = "form";
                $path = $namePath . "/" . $name_picture;
                $file = $request->file($key)[$file];
                $file->storeAs($namePath, $name_picture, 'public');
                $namePath = "form";
                $path = $namePath . "/" . $name_picture;
                $item->identity = $identity . '-' . $random;
                $item->save();
                $item->files()->create(['link' => $path, 'type' => 'image']);
                $file++;
            } else {
                $item = new FormResult();
                $item->form_id = $value[0];
                $item->value = $value[1];
                $item->type = $value[2];
                $item->identity = $identity . '-' . $random;
                $item->save();
                $iden = $item->identity;
            }
        }
        $formData = [
            'subevent' => $subevent->name,
            'identity' => $iden,
        ];

        $userSchema = User::where('role_id', 1)->first();

        Notification::send($userSchema, new FormsNotification($formData));

        return redirect()->back()->with('success', 'Berhasil Melakukan Pendaftaran');
    }
}

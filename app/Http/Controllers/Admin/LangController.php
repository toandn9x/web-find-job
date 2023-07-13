<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
    public function changeLanguage (Request $request) {

        $lang = $request->language;
        
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        }
        if ($lang == 'vi') {
            $language = 'vi';
        }
        Session::put('language', $language);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request, string $lang) {
        $supportedLangs = ['en', 'vi'];
        $lowerLang = Str::lower($lang);

        if (in_array($lowerLang, $supportedLangs)) {
            Cookie::queue('lang', $lang);
        }

        return redirect()->back();
    }
}

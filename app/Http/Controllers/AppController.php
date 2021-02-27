<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function changeLocale(Request $request)
    {
        $language = $request->post('language');
        $validLocales = \Config::get('constant.web.locale.validLocales');
        $defaultLocale = \Config::get('constant.web.locale.default');
        $localeKey = \Config::get('constant.web.locale.key');
        $expire = \Config::get('constant.web.locale.expire');
        if (in_array($language, $validLocales)) {
            \App::setLocale($language);
            $cookie = cookie($localeKey, $language, $expire);
            return redirect()->back()->cookie($cookie);
        }
        \App::setLocale($defaultLocale);
        return redirect()->back()
            ->withErrors(['invalidLocale' => __('message.error.invalidLocale')]);
    }
}

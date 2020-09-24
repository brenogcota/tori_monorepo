<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{

    static function setCookie($value) {

        $expiration = 60 * 24; // expire in one day
        $cookie = Cookie::make('token', $value, $expiration);
        Cookie::queue($cookie);

        return response();
    }

    static function removeCookie() {
        Cookie::queue(Cookie::forget('token'));

        return response();
    }

}
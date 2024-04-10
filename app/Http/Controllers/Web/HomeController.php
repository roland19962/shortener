<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UrlAlias;

class HomeController extends Controller
{
    public function indexAction()
    {
        return view('index');
    }

    public function redirectHashAction($hash) {

        $currentHash = htmlspecialchars(trim($hash));

        $currentUrlAlias = UrlAlias::find($currentHash);
        if ($currentUrlAlias instanceof UrlAlias) {
            return redirect($currentUrlAlias->url);
        }

        return view('error');
    }

    public function redirectSomethingHashAction($something, $hash) {

        $currentHash = htmlspecialchars(trim($hash));

        $currentUrlAlias = UrlAlias::find($currentHash);
        if ($currentUrlAlias instanceof UrlAlias) {
            return redirect($currentUrlAlias->url);
        }

        return view('error');
    }
}

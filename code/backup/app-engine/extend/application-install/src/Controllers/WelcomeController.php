<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return Application|Factory|View
     */
    public function welcome()
    {
        $content = file_get_contents(base_path('LICENSE'));
        return view('application-install::welcome', [
            'content' => $content
        ]);
    }
}

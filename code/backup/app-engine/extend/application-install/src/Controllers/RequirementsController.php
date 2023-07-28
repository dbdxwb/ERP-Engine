<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Routing\Controller;

class RequirementsController extends Controller
{

    public function requirements()
    {
        $minPHP = '7.4.0';
        $currentPHP = $this->getPhpVersionInfo();

        $error = false;

        $data = [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'Redis',
        ];
        $requirements = [
            'php' => $currentPHP['version']
        ];
        if (version_compare($currentPHP['version'], $minPHP) < 0) {
            $requirements['php'] = false;
            $error = true;
        }

        foreach ($data as $vo) {
            $requirements[$vo] = true;
            if (!extension_loaded($vo)) {
                $requirements[$vo] = false;
                $error = true;
            }
        }


        return view('application-install::requirements', [
            'minPHP' => $minPHP,
            'currentPHP' => $currentPHP,
            'requirements' => $requirements,
            'error' => $error
        ]);
    }

    private static function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }
}

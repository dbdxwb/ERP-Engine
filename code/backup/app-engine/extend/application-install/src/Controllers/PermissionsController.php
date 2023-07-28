<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Routing\Controller;
use DevEngineInstaller\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    public function permissions()
    {

        $data = [
            'storage/framework/' => '755',
            'storage/logs/' => '755',
            'bootstrap/cache/' => '755',
            // 'public/upload/' => '755',
        ];

        $folders = [];
        $error = false;

        foreach ($data as $folder => $permission) {
            if (! ($this->getPermission($folder) >= $permission)) {
                $folders[] = [
                    'folder' => $folder,
                    'permission' => $permission,
                    'status' => false
                ];
                $error = true;
            } else {
                $folders[] = [
                    'folder' => $folder,
                    'permission' => $permission,
                    'status' => true
                ];
            }
        }
        return view('application-install::permissions', [
            'folders' => $folders,
            'error' => $error
        ]);
    }

    private function getPermission($folder)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }
}

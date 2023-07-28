<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Routing\Controller;
// use DevEngineInstaller\Helpers\DatabaseManager;
// use DevEngineInstaller\Helpers\InstalledFileManager;

class UpdateController extends Controller
{
    // use \DevEngineInstaller\Helpers\MigrationsHelper;
    //
    // /**
    //  * Display the updater welcome page.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function welcome()
    // {
    //     return view('application-install::update.welcome');
    // }
    //
    // /**
    //  * Display the updater overview page.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function overview()
    // {
    //     $migrations = $this->getMigrations();
    //     $dbMigrations = $this->getExecutedMigrations();
    //
    //     return view('application-install::update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    // }
    //
    // /**
    //  * Migrate and seed the database.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function database()
    // {
    //     $databaseManager = new DatabaseManager;
    //     $response = $databaseManager->migrateAndSeed();
    //
    //     return redirect()->route('LaravelUpdater::final')
    //                      ->with(['message' => $response]);
    // }
    //
    // /**
    //  * Update installed file and display finished view.
    //  *
    //  * @param InstalledFileManager $fileManager
    //  * @return \Illuminate\View\View
    //  */
    // public function finish(InstalledFileManager $fileManager)
    // {
    //     $fileManager->update();
    //
    //     return view('application-install::update.finished');
    // }
}

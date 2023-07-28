<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Routing\Controller;
use DevEngineInstaller\Events\InstallSeed;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseController extends Controller
{

    public function database()
    {
        $outputLog = new BufferedOutput;
        $response = $this->migrate($outputLog);
        return redirect()->route('DevEngineInstaller::final')->with(['message' => $response]);

    }

    /**
     * 合并数据表结构
     * @param BufferedOutput $outputLog
     * @return array
     */
    private function migrate(BufferedOutput $outputLog)
    {
        Artisan::call('migrate', ['--force' => true], $outputLog);
        try {
            Artisan::call('migrate', ['--force' => true], $outputLog);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 'error', $outputLog);
        }
        return $this->seed($outputLog);
    }

    /**
     * 合并安装数据
     * @param BufferedOutput $outputLog
     * @return array
     */
    private function seed(BufferedOutput $outputLog)
    {
        try {
            $data = array_filter(event(new InstallSeed));
            foreach ($data as $vo) {
                Artisan::call('db:seed', [
                    '--force' => true,
                    '--class' => $vo,
                ]);
            }
            Artisan::call('db:seed', ['--force' => true], $outputLog);
        } catch (Exception $e) {
            return $this->response($e->getMessage(), 'error', $outputLog);
        }
        return $this->response('安装数据成功', 'success', $outputLog);
    }

    /**
     * @param $message
     * @param $status
     * @param BufferedOutput $outputLog
     * @return array
     */
    private function response($message, $status, BufferedOutput $outputLog)
    {
        return [
            'status' => $status,
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}

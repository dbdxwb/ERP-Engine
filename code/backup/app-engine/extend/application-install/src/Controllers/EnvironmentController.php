<?php

namespace DevEngineInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use function Couchbase\defaultDecoder;

class EnvironmentController extends Controller
{

    private $envPath;

    private $envExamplePath;

    private $fields = [];
    private $rules = [];

    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');

        $this->fields = [
            [
                'APP_NAME' => '系统名称',
                'APP_URL' => '系统地址',
            ],
            [
                'DB_HOST' => '数据库地址',
                'DB_PORT' => '数据库端口',
                'DB_DATABASE' => '数据库名',
                'DB_USERNAME' => '数据库账号',
                'DB_PASSWORD' => '数据库密码',
                'DB_TABLE_PREFIX' => '数据表前缀',
            ]
        ];
        $this->rules = [
            'APP_NAME' => 'required|string|max:50',
            'APP_URL' => 'required|url',
            'DB_HOST' => 'required|string|max:50',
            'DB_PORT' => 'required|numeric',
            'DB_DATABASE' => 'required|string|max:50',
            'DB_USERNAME' => 'required|string|max:50',
            'DB_PASSWORD' => 'nullable|string|max:50',
            'DB_TABLE_PREFIX' => 'nullable|string|max:50',
        ];
    }

    public function environment()
    {
        $envConfig = $this->getEnvContent();
        return view('application-install::environment', [
            'env' => \Dotenv\Dotenv::parse($envConfig),
            'data' => $this->fields
        ]);
    }

    public function save(Request $request, Redirector $redirect)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return $redirect->route('DevEngineInstaller::environment')->withInput()->withErrors($validator->errors());
        }

        if (!$this->checkDatabaseConnection($request)) {
            return $redirect->route('DevEngineInstaller::environment')->withInput()->withErrors([
                'DB_HOST' => '数据库连接失败',
            ]);
        }

        $data = $request->input();
        $contentArray = collect(file($this->envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($data) {
            foreach ($data as $key => $vo) {
                if (str_contains($item, $key . '=')) {
                    return $key . '=' . $vo;
                }
            }
            return $item;
        });
        $content = implode("\n", $contentArray->toArray());

        $results = '配置文件保存成功';
        try {
            file_put_contents($this->envPath, $content);
        } catch (Exception $e) {
            $results = '配置文件保存失败';
        }

        return $redirect->route('DevEngineInstaller::database')
            ->with(['results' => $results]);
    }

    private function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    private function checkDatabaseConnection(Request $request)
    {
        $connection = 'mysql';

        $settings = config("database.connections.$connection");

        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver' => $connection,
                        'host' => $request->input('DB_HOST'),
                        'port' => $request->input('DB_PORT'),
                        'database' => $request->input('DB_DATABASE'),
                        'username' => $request->input('DB_USERNAME'),
                        'password' => $request->input('DB_PASSWORD'),
                    ]),
                ],
            ],
        ]);

        DB::purge();
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

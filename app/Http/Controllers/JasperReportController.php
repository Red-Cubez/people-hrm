<?php

namespace People\Http\Controllers;

use JasperPHP;

class JasperReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	dd("show all report button here");
       
    }

    public function employeesWithHourlyRate($fileExtension)
    {
        return $this->processJasperReport('employees_with_hourly_rate',$fileExtension);

    }

    public function processJasperReport($fileName,$fileExtension)
    {
        
        // JasperPHP::compile(base_path() . '/public/report/employees.jrxml')->execute();
        $output = public_path() . '/report/' . time() . '_' . $fileName;

        JasperPHP::process(
            public_path() . '/report/' . $fileName . '.jasper',
            $output,
            array($fileExtension),
            null,
            $this->getDatabaseConfig()

        )->execute();

        $file = $output . '.'.$fileExtension;

        $path = $file;

        if (!file_exists($file)) {
            abort(404);
        }

        $file = file_get_contents($file);

        unlink($path);

        return response($file, 200)
            ->header('Content-Type', 'application/'.$fileExtension)
            ->header('Content-Disposition', 'inline; filename=' . $fileName . '.'.$fileExtension);

        // JasperPHP::process(
        //     base_path() . '/public/report/employees.jasper',
        //     false,
        //     array("pdf"),
        //     array("php_version" => phpversion())
        // )->execute();
        // dd(base_path() . '/vendor/cossou/jasperphp/examples/hello_world.jrxml');
    }

    public function getDatabaseConfig()
    {
        return [
            'driver'   => env('DB_CONNECTION'),
            'host'     => env('DB_HOST'),
            'port'     => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            // 'jdbc_driver' => base_path() .'/vendor/cossou/jasperphp/src/JasperStarter/jdbc/mysql-connector-java-5.1.44-bin.jar',
        ];
    }
}

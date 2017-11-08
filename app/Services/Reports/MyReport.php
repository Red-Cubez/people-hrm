<?php
//MyReport.php
namespace People\Services\Reports;

use People\Models\Client;
require_once dirname(__FILE__)."/../../../vendor/koolreport/autoload.php";

class MyReport extends \koolreport\KoolReport
{
	use \koolreport\excel\ExcelExportable;
    //We leave this blank to demo only
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "mysql_datasource"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=people",
                    "username"=>"homestead",
                    "password"=>"secret",
                    "charset"=>"utf8"
                ),
            )
        );
    }

    public function setup()
    {
        $this->src('mysql_datasource')
        ->query("SELECT * FROM employees ")
        ->pipe($this->dataStore('employee_detail'));
    }
}
<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\PieChart;
?>

<div class="text-center">
    <h1>Test Report</h1>
    <h4></h4>
</div>
<hr/>

<?php

    PieChart::create(array(
        "dataStore"=>$this->dataStore('employee_detail'),
        "width"=>"100%",
        "height"=>"500px",
        "columns"=>array(
            "firstName"=>array(
                "label"=>"firstName"
            ),
            "hourlyRate"=>array(
                "type"=>"number",
                "label"=>"hourlyRate",
                "prefix"=>"$",
            )
        ),
        "options"=>array(
            "title"=>"Employee"
        )
    ));
?>
<?php
Table::create(array(
    "dataStore"=>$this->dataStore('employee_detail'),
        "columns"=>array(
            "firstName"=>array(
                "label"=>"firstName"
            ),
            "lastName"=>array(
               
                "label"=>"lastName",
                
            ),
             "hireDate"=>array(
                "type"=>"date",
                "label"=>"hireDate",
          
            ),
              "hourlyRate"=>array(
                "type"=>"number",
                "label"=>"hourlyRate",
                "prefix"=>"$",
            )
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));

?>
			
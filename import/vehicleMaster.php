<?php
/**
 * @author Mehedi Hasan
 * @copyright 2012
 * */
?>
<?php
require_once 'reader.php';
require_once 'dbconnect.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');

//$data->read('Files/product_to_store.xls');
$data->read('xls/vehicle-Master.xls');
?>
<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="Rajib Kumar Rakhmit" />
    <title>Travel</title>
</head>

<body>
    <?php //error_reporting(E_ALL ^ E_NOTICE);?>

    <?php
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
        for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			if($data->sheets[0]['cells'][$i][$j]=='')
				$value[$j]='';
			else
				$value[$j] = $data->sheets[0]['cells'][$i][$j];
        }
		
        mysql_query("insert into vehicle_master(vehicle_name, short_code, owner_name, fathers_husband_name, address, registration_number, registration_date, model, engine_number, chesis_number, permit_number, permit_validity, type_vehicle, vehicle_category, vehicle_type, vehicle_number, upload_images, seating_capacity, attachment_name, file_upload, choose_branch, country, state, city) values ('".$value[1]."','".$value[2]."','".$value[3]."','".$value[4]."','".$value[5]."','".$value[6]."','".$value[7]."','".$value[8]."','".$value[9]."','".$value[10]."','".$value[11]."','".$value[12]."','".$value[13]."','".$value[14]."','".$value[15]."','".$value[16]."','".$value[17]."','".$value[18]."','".$value[19]."','".$value[20]."','".$value[21]."','".$value[22]."','".$value[23]."','".$value[24]."')");
    
  //  echo "insert into vehicle_master(vehicle_name, short_code, owner_name, father_husband_name, address, registration_number, registration_date, model, engine_number, chesis_number, permit_number, permit_validity, type_vehicle, vehicle_category, vehicle_type, vehicle_number, upload_images, seating_capacity, attachment_name, file_upload, choose_branch, country, state, city) values ('".$value[1]."','".$value[2]."','".$value[3]."','".$value[4]."','".$value[5]."','".$value[6]."','".$value[7]."','".$value[8]."','".$value[9]."','".$value[10]."','".$value[11]."','".$value[12]."','".$value[13]."','".$value[14]."','".$value[15]."','".$value[16]."','".$value[17]."','".$value[18]."','".$value[19]."','".$value[20]."','".$value[21]."','".$value[22]."','".$value[23]."','".$value[24]."')";
    
        
       // echo "insert into vehicle_master(vehicle_name,short_code,owner_name,father_husband_name,address,registration_number,registration_date,model,engine_number,chesis_number,permit_number,type_vehicle,vehicle_category,vehicle_type,vehicle_number,upload_images,seating_capacity,attachment_name,file_upload,choose_branch,country,state,city ) values ('".$value[1]."','".$value[2]."','".$value[3]."','".$value[4]."','".$value[5]."','".$value[6]."','".$value[7]."','".$value[8]."','".$value[9]."','".$value[10]."','".$value[11]."','".$value[12]."','".$value[13]."','".$value[14]."','".$value[15]."','".$value[16]."','".$value[17]."','".$value[18]."','".$value[19]."','".$value[20]."','".$value[21]."','".$value[22]."','".$value[23]."','".$value[24]."')";
        }
    
    $i -=2;
    echo $i.' Row Inserted';
    ?>
</body>
</html>
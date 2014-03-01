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
$data->read('xls/Approved-Shops-Master-Contact.xls');
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
		
		
        mysql_query("insert into  approved_moredetail
(shops_name,name,mobile_no,Email_id) values ('".$value[1]."','".$value[2]."','".$value[3]."','".$value[4]."')");
		
    }
    $i -=2;
    echo $i.' Row Inserted';
    ?>
</body>
</html>
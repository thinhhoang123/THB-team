<?php
    header('Content-Type: application/json');

    // dang nhap vao database
    include("config.php");
	
	$sql = "select * from datetime";
    $result = mysqli_query($conn, $sql); // di xuong csdl lay data sau do luu vao bien result
    $data1 = mysqli_fetch_row($result);
    $date = $data1[0];
	
    // Doc gia tri RGB tu database
    $sql = "select * from(select *from park where created_at between '$date 00:00:00' and '$date 12:00:00' order by stt desc limit 50)var1  ORDER BY stt ASC;";
    $result = mysqli_query($conn,$sql);
    $data = array();
    foreach ($result as $row){
        $data[] = $row;
    }
    // add random data
    mysqli_close($conn);
    echo json_encode($data);

    

?>
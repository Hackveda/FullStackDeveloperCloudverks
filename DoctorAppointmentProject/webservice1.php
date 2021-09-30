<?php

$search_param = $_POST["search"];
$search_area = $_POST["area"];

if(isset($_POST["search"]) && isset($_POST["area"])){
    
//echo $search_param;
//echo $search_area;
    
// Connect to database
$host = "localhost";
$dbuser = "hackveda_doctor";
$dbpass = "abcde12345";
$dbname = "hackveda_doctor";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

$sql = "SELECT * FROM `doctors` WHERE DoctorArea like '%".$search_area."%' and DoctorCategory like '%".$search_param."%'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    
    $data = '<div class="lbl-title-section3-WYJxxj">Doctors found in your area</div>';
    $doctor_data = "";
    
    while($row = $result->fetch_assoc()){
        $doctorid = $row["ID"];
        $doctorname = $row["DoctorName"];
        $doctorinfo = $row["DoctorInformation"];
        $doctorimage = $row["DoctorImage"];
        
        $doctor_data = $doctor_data.'<div class="search-section-WYJxxj smart-layers-pointers">
            <div class="search-box-vYzqLm">
              <div class="search-bg-gDPMPr"></div>
              <img class="search-icon-gDPMPr" src="'.$doctorimage.'" />
            </div>
            <div class="title-search-doctor-vYzqLm roboto-bold-black-36px">'.$doctorname.'</div>
            <div class="desc-seacrh-doctor-vYzqLm roboto-normal-black-24px">
              '.$doctorinfo.'
            </div>
          </div>';
    }
    
}else{
    $data = '<div class="lbl-title-section3-WYJxxj">No Doctor found in your area</div>';
}

// Sending response back to the request
// echo json_encode($data);
    
}else{
    $data = '<div class="lbl-title-section3-WYJxxj">Bad Query</div>';
}

$data = $data.$doctor_data;
echo $data;
?>
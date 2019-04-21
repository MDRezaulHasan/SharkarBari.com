<?php
session_start();
include 'database/db_connection.php';
include 'helpers/function.php';

if (!isset($_SESSION['email']) == true) {
    header("Location: index.php");
}
if(!isset($_GET['flat_rent_id']) || $_GET['flat_rent_id'] == NULL){
    header("Location:owner-account.php");
}else{
    global $con;
    $flat_rent_id = $_GET['flat_rent_id'];
    $owner_id = $_SESSION['owner_id'];
    
    $query = "SELECT * FROM  tbl_flat_rent_ads WHERE id='$flat_rent_id' AND owner_id='$owner_id'";
    $getData = mysqli_query($con,$query);
    if($getData){
        while ($delimg = mysqli_fetch_array($getData)){
            $dellink = $delimg['flat_image'];
            unlink($dellink);
        }
    }

    $delquery = "DELETE FROM tbl_flat_rent_ads WHERE id='$flat_rent_id' AND owner_id='$owner_id'";
    $delData= mysqli_query($con,$delquery);
    if ($delData) {
        echo "<script>alert('Data Successfully Deleted.');</script>";
        echo "<script>window.location = 'owner-account.php';</script>";
    } else {
        echo "<script>alert('Data Not Deleted.');</script>";
        echo "<script>window.location = 'owner-account.php';</script>";
    }
}



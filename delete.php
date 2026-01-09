<?php
include "connection.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Delete query
    $delete = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    if($delete){
        echo "<script>alert('Product Deleted Successfully!'); window.location='view_product.php';</script>";
    } else {
        echo "<script>alert('Failed to Delete Product'); window.location='view_product.php';</script>";
    }

} else {
    echo "<script>alert('Invalid Request'); window.location='view_product.php';</script>";
}
?>

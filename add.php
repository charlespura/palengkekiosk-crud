<?php
include "connection.php";

// When Save button clicked
if(isset($_POST['save'])){

    // Get input values
    $name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Insert Query
    $insert = mysqli_query($conn,
        "INSERT INTO products(product_name,category,price,stock)
         VALUES('$name','$category','$price','$stock')"
    );

    // Check if successful
    if($insert){
        echo "<script>alert('Product Added Successfully!'); window.location='add.php';</script>";
    } else {
        echo "<script>alert('Failed to Add Product');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

<style>
body{
    background:#f5f5f5;
    font-family: Arial;
}
.container{
    width:400px;
    background:white;
    margin:40px auto;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,.2);
}
h2{
    text-align:center;
}
input{
    width:100%;
    padding:8px;
    margin:6px 0;
    border-radius:5px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    background:#28a745;
    color:white;
    font-weight:bold;
    cursor:pointer;
    margin:10px;
}

.btn{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    background:#007bff;
    color:white;
    font-weight:bold;
    cursor:pointer;
    margin:10px;
}
a{
    text-decoration:none;
}
.back{
    display:block;
    text-align:center;
    margin-top:10px;
}

</style>

</head>

<body>

<div class="container">
<h2>Add Product</h2>

<form method="POST">

    <label>Product Name</label>
    <input type="text" name="product_name" required>

    <label>Category</label>
    <input type="text" name="category" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <label>Stock</label>
    <input type="number" name="stock" required>

    <button type="submit" name="save">Save Product</button>
<button type="button" class= "btn"onclick="window.location.href='view_product.php'">
    View Product
</button>


</form>


</div>

</body>
</html>

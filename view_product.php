<?php
include "connection.php";

// Fetch all products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Product List</title>

<style>
body{
    font-family: Arial;
    background:#f5f5f5;
}
.container{
    width:800px;
    margin:40px auto;
    background:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,.2);
}
table{
    width:100%;
    border-collapse: collapse;
}
th, td{
    padding:10px;
    text-align:left;
    border-bottom:1px solid #ddd;
}
th{
    background:#007bff;
    color:white;
}
a{
    text-decoration:none;
    color:#007bff;
    font-weight:bold;
}
.add-btn{
    display:inline-block;
    margin-bottom:10px;
    background:#28a745;
    color:white;
    padding:8px 12px;
    border-radius:5px;
}
</style>

</head>
<body>

<div class="container">
<h2>Product List</h2>

<a class="add-btn" href="add.php">+ Add New Product</a>

<table>
<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['stock']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">
Delete
</a>

    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>

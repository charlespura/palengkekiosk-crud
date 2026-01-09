
<?php
// Enable error display and logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set error log file
ini_set('error_log', 'error.log');
?>

<?php
include "connection.php";

// INSERT
if(isset($_POST['save'])){
    $name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $insert = mysqli_query($conn,
        "INSERT INTO products(product_name,category,price,stock)
         VALUES('$name','$category','$price','$stock')"
    );

    if($insert){
        echo "<script>alert('Product Added Successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to Add Product!');</script>";
    }
}

// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = mysqli_query($conn, "DELETE FROM products WHERE id='$id'");

    if($delete){
        echo "<script>alert('Product Deleted Successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to Delete Product!');</script>";
    }
}

// UPDATE
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $update = mysqli_query($conn,
        "UPDATE products SET 
         product_name='$name',
         category='$category',
         price='$price',
         stock='$stock'
         WHERE id='$id'"
    );

    if($update){
        echo "<script>alert('Product Updated Successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to Update Product!');</script>";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Palengke Kiosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body{
    background:#f5f5f5;
    font-family: Arial;
    margin:0;
}

.container{
    width:95%;
    max-width:1100px;
    margin:auto;
    padding:20px;
}

h2{
    text-align:center;
    margin-bottom:20px;
}

/* Layout */
.row{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

/* Cards */
.card{
    background:white;
    border-radius:8px;
    padding:15px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
    width:100%;
}

.col-left{
    flex:1;
    min-width:260px;
}

.col-right{
    flex:2;
    min-width:300px;
}

/* Headers */
.card-header{
    padding:10px;
    font-weight:bold;
    color:white;
    border-radius:5px 5px 0 0;
}

.green{ background:#28a745; }
.blue{ background:#007bff; }
.yellow{ background:#ffcc00; color:#000; }

/* Inputs */
input{
    width:100%;
    padding:8px;
    margin:6px 0;
    border-radius:5px;
    border:1px solid #ccc;
}

/* Buttons */
button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
}

.btn-success{ background:#28a745; color:white; }
.btn-warning{ background:#ff9800; color:white; }
.btn-danger{ background:#e22424; color:white; }

/* Table */
.table-box{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#333;
    color:white;
}

/* Responsive */
@media(max-width:768px){
    .row{
        flex-direction:column;
    }
}
</style>

</head>

<body>

<div class="container">

<h2>Palengke Kiosk Management</h2>

<div class="row">

<!-- ADD PRODUCT -->
<div class="col-left">
    <div class="card">
        <div class="card-header green">Add Product</div>

        <form method="POST">
            <label>Product Name</label>
            <input type="text" name="product_name" required>

            <label>Category</label>
            <input type="text" name="category" required>

            <label>Price</label>
            <input type="number" step="0.01" name="price" required>

            <label>Stock</label>
            <input type="number" name="stock" required>

            <button name="save" class="btn-success">Save</button>
        </form>
    </div>
</div>

<!-- PRODUCT LIST -->
<div class="col-right">
    <div class="card">
        <div class="card-header blue">Product List</div>

        <div class="table-box">
        <table>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['category'] ?></td>
                <td>₱<?= $row['price'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td>
                    <a href="index.php?edit=<?= $row['id'] ?>"><button class="btn-warning">Edit</button></a>
                    <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this?')">
                        <button class="btn-danger">Delete</button>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
        </div>

    </div>
</div>

</div>

<!-- EDIT FORM -->
<?php
if(isset($_GET['edit'])){
$id = $_GET['edit'];
$get = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$data = mysqli_fetch_assoc($get);
?>

<div class="card" style="margin-top:20px;">
    <div class="card-header yellow">Edit Product</div>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Product Name</label>
        <input type="text" name="product_name" value="<?= $data['product_name'] ?>" required>

        <label>Category</label>
        <input type="text" name="category" value="<?= $data['category'] ?>" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="<?= $data['price'] ?>" required>

        <label>Stock</label>
        <input type="number" name="stock" value="<?= $data['stock'] ?>" required>

        <button name="update" class="btn-warning">Update</button>
    </form>
</div>

<?php } ?>

</div>

</body>
</html>

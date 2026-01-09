<?php
include "connection.php";

// Get product id
$id = $_GET['id'];

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

// When update button clicked
if(isset($_POST['update'])){
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
        echo "<script>alert('Product Updated Successfully!'); window.location='product_list.php';</script>";
    } else {
        echo "<script>alert('Failed to Update Product');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
</head>
<body>

<h2>Edit Product</h2>

<form method="POST">

<label>Product Name</label>
<input type="text" name="product_name" value="<?php echo $data['product_name']; ?>" required>

<label>Category</label>
<input type="text" name="category" value="<?php echo $data['category']; ?>" required>

<label>Price</label>
<input type="number" step="0.01" name="price" value="<?php echo $data['price']; ?>" required>

<label>Stock</label>
<input type="number" name="stock" value="<?php echo $data['stock']; ?>" required>

<button type="submit" name="update">Update Product</button>

</form>

</body>
</html>

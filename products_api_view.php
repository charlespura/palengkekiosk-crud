<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$api_url = "http://localhost/GithubProject/palengkekiosk/productApi.php";
$response = file_get_contents($api_url);
$result = json_decode($response, true);
$products = $result['data'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Product List (API)</title>

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
</style>
</head>

<body>
<div class="container">
<h2>Product List (From API)</h2>

<table>
<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Stock</th>
</tr>

<?php foreach ($products as $product) { ?>
<tr>
    <td><?= $product['id']; ?></td>
    <td><?= $product['product_name']; ?></td>
    <td><?= $product['category']; ?></td>
    <td><?= $product['price']; ?></td>
    <td><?= $product['stock']; ?></td>
</tr>
<?php } ?>

</table>
</div>
</body>
</html>

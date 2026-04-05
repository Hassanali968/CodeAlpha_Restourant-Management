<?php
include("connection.php");

if(!isset($_GET['id'])){
    die("Invalid ID");
}

$id = $_GET['id'];

// Fetch product
$q = "SELECT * FROM orders WHERE id='$id'";
$result = mysqli_query($con,$q);
$data = mysqli_fetch_assoc($result);

if(!$data){
    die("Product not found!");
}

if(isset($_POST['Update'])){
    $table_id = $_POST['table_id'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];

    $update = "UPDATE orders SET
        table_id='$table_id',
        item_name='$item_name',
        price='$price'
        WHERE id='$id'";

    $run = mysqli_query($con,$update);

    if($run){
        header("Location: show.php"); 
        exit();
    } else {
        echo "<script>alert('Error: ".mysqli_error($con)."');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<style>
/* Body & Sidebar */
body {
    margin:0;
    font-family:Segoe UI, Arial;
    background:#f4f6f9;
}

.sidebar{
    width:230px;
    height:100vh;
    background:#1e293b;
    position:fixed;
    color:white;
}

.sidebar h2{
    text-align:center;
    padding:20px 0;
    border-bottom:1px solid #334155;
}

.sidebar a{
    display:block;
    padding:12px 20px;
    text-decoration:none;
    color:#e2e8f0;
}

.sidebar a:hover{
    background:#334155;
}

/* Main content */
.main{
    margin-left:230px;
    padding:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* Form */
form label{
    display:block;
    margin-top:15px;
    font-weight:bold;
}

form input, form textarea{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #d1d5db;
    border-radius:6px;
    font-size:14px;
}

form textarea{
    height:80px;
    resize:none;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:6px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#1d4ed8;
}
</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="insert.php">Place Order</a>
    <a href="show.php">Our Menu</a>
    <a href="Reservation.php">Reservation</a>
    <a href="Show Reservation.php">Show Reservation</a>
</div>

<div class="main">
    <div class="card">
        <h2>Edit Product</h2>
        <form method="POST">
            <label>Table ID</label>
            <input type="text" name="table_id" value="<?php echo $data['table_id']; ?>" required>

            <label>Item Name</label>
            <textarea name="item_name" required><?php echo $data['item_name']; ?></textarea>

            <label>Price</label>
            <input type="text" name="price" value="<?php echo $data['price']; ?>" required>

            <button type="submit" name="Update">Update Product</button>
        </form>
    </div>
</div>

</body>
</html>
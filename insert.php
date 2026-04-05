<?php
include("connection.php");

// Total Products
$pq = mysqli_query($con,"SELECT * FROM orders");
$total_products = mysqli_num_rows($pq);

// Total Tables (users)
$uq = mysqli_query($con, "SELECT * FROM tables");
$total_tables = mysqli_num_rows($uq);

if(isset($_POST['place_order'])){

    $table_id = $_POST['table_id'];
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];

    // Validation
    if($table_id == ""){
        echo "<script>alert('Table ID is required')</script>";
    } elseif($item_name == ""){
        echo "<script>alert('Item Name is required')</script>";
    } elseif($price == ""){
        echo "<script>alert('price is required')</script>";
    } else {
        $q = "INSERT INTO orders (table_id, item_name, price) VALUES ('$table_id','$item_name','$price')";
        $result = mysqli_query($con,$q);

        if($result){
            echo "<script>
                alert('Order successfully added!');
                window.location.href='show.php';
            </script>";
        } else {
            echo "<script>
                alert('Error: Order not added!');
            </script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>

<style>

body{
margin:0;
font-family:Segoe UI, Arial;
background:#f4f6f9;
}

/* Sidebar */

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

/* Dropdown */

.menu{
position:relative;
}

.submenu{
display:none;
background:#0f172a;
}

.submenu a{
padding-left:40px;
font-size:14px;
}

.menu:hover .submenu{
display:block;
}

/* Main */

.main{
margin-left:230px;
padding:30px;
}

/* Card */

.card{
background:white;
padding:25px;
border-radius:10px;
margin-bottom:20px;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* Form */

form{
margin-top:15px;
}

label{
font-size:14px;
color:#374151;
}

input, textarea{
width:100%;
padding:12px;
margin-top:5px;
margin-bottom:15px;
border:1px solid #d1d5db;
border-radius:6px;
font-size:14px;
}

input:focus, textarea:focus{
border-color:#2563eb;
outline:none;
box-shadow:0 0 5px rgba(37,99,235,0.3);
}

textarea{
height:90px;
resize:none;
}

input[type=file]{
background:#f1f5f9;
}

button{
background:#2563eb;
color:white;
border:none;
padding:12px 20px;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#1d4ed8;
}

</style>
</head>

<body>

<div class="sidebar">

<h2>Admin Panel</h2>

<a href="#dashboard">Dashboard</a>

<div class="menu">
<a href="insert.php">Place Order</a>

</div>

<div class="menu">
<a href="show.php">Our Menu</a>
<a href="Reservation.php">Reservation </a>
<a href="Show Reservation.php">Show Reservation </a>
</div>



</div>


<div class="main">

<div id="dashboard" class="card">
<h2>Dashboard</h2>
<p>Total tables: <b><?php echo $total_products; ?></b></p>

</div>


<div class="card">

<div class="card">
    <h2>Place Order</h2>
    <form method="POST">

        <label>Table ID</label>
        <input type="number" name="table_id" placeholder="Enter Table ID" required>

        <label>Item Name</label>
        <input type="text" name="item_name" placeholder="Enter Item Name" required>

        <label>Price</label>
        <input type="number" name="price" placeholder="Enter price" min="1" required>

        <button type="submit" name="place_order">Place Order</button>

    </form>
</div>
</div>

</body>
</html>


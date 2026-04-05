<?php
include('connection.php');
$q = "SELECT * FROM `orders`";
$result = mysqli_query($con, $q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Our Menu</title>
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
.menu{position:relative;}
.submenu{
    display:none;
    background:#0f172a;
}
.submenu a{
    padding-left:40px;
    font-size:14px;
}
.menu:hover .submenu{display:block;}

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

/* Table */
table {
    width:100%;
    border-collapse: collapse;
    margin-top: 15px;
}
th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}
th {
    background:#2563eb;
    color:white;
}
td .action-box{
    display: flex;
    justify-content: center;
    gap: 10px;
}
td a.edit-btn, td a.delete-btn {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 6px;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}
td a.edit-btn {
    background: linear-gradient(135deg, #4facfe, #007bff);
}
td a.delete-btn {
    background: linear-gradient(135deg, #ff6a6a, #dc3545);
}
td a.edit-btn:hover {
    background: #0056b3;
    transform: translateY(-2px);
}
td a.delete-btn:hover {
    background: #b02a37;
    transform: translateY(-2px);
}
</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="insert.php">Place Order</a>
    <a href="show.php">Our Menu</a>
    <a href="reservation.php">Reservation</a>
    <a href="show reservation.php">Show Reservation</a>
</div>

<div class="main">
    <div class="card">
        <h2>Our Menu</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Table ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php 
            $sn = 1;
            while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $row['table_id']; ?></td>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <div class="action-box">
                        <a class='edit-btn' href='edit.php?id=<?php echo $row['id']; ?>'>Edit</a>
                        <a class='delete-btn' href='delete.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </div>
                </td>
            </tr>
            <?php 
            $sn++;
            } ?>
        </table>
    </div>
</div>

</body>
</html>
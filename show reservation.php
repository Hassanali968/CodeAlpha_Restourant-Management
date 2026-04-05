<?php
include("connection.php"); 

// Accept reservation
if(isset($_GET['accept'])){
    $id = $_GET['accept'];
    mysqli_query($con, "UPDATE reservations SET status='Accepted' WHERE id='$id'");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Pending reservation
if(isset($_GET['pending'])){
    $id = $_GET['pending'];
    mysqli_query($con, "UPDATE reservations SET status='Pending' WHERE id='$id'");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all reservations
$q = "SELECT * FROM reservations ORDER BY reservation_date, reservation_time";
$result = mysqli_query($con, $q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reservations List</title>
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
}
th, td {
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
th {
    background-color:#2563eb;
    color:white;
}
tr:hover {
    background-color:#f2f2f2;
}
.btn {
    padding:6px 12px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:white;
    text-decoration:none;
}
.accept {
    background-color: #28a745;
}
.pending {
    background-color: #ffc107;
    color:black;
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
        <h2>All Reservations</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Table ID</th>
                <th>User Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['table_id']."</td>
                            <td>".$row['customer_name']."</td>
                            <td>".$row['reservation_date']."</td>
                            <td>".$row['reservation_time']."</td>
                            <td>".$row['status']."</td>
                            <td>
                                <a href='?accept=".$row['id']."' class='btn accept'>Accept</a>
                                <a href='?pending=".$row['id']."' class='btn pending'>Pending</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No Reservations Found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
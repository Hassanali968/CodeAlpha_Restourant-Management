<?php
include("connection.php");

if(isset($_POST['reserve'])){
    $table_id = mysqli_real_escape_string($con, $_POST['table_id'] ?? '');
    $name = mysqli_real_escape_string($con, $_POST['customer_name'] ?? '');
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    $today = date("Y-m-d");
    $max_date = date("Y-m-d", strtotime("+1 month"));

    if($date < $today || $date > $max_date){
        echo "<script>alert('Reservation date must be within 1 month from today');</script>";
    } else {
        $q = "INSERT INTO reservations (table_id, customer_name, reservation_date, reservation_time) 
              VALUES ('$table_id','$name','$date','$time')";

        $result = mysqli_query($con, $q);

        if($result){
            echo "<script>
                alert('Reservation Successful');
                window.location.href='show reservation.php';
            </script>";
        } else {
            echo "<script>alert('Error Occurred');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Table Reservation</title>
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

/* Form */
form{
    margin-top:15px;
}
label{
    font-size:14px;
    color:#374151;
    font-weight:bold;
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
button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:6px;
    cursor:pointer;
}
button:hover{background:#1d4ed8;}
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
        <h2>Table Reservation</h2>
        <form method="POST">
            <label>Table ID</label>
            <input type="number" name="table_id" placeholder="Enter Table ID" required>

            <label>Your Name</label>
            <input type="text" name="customer_name" placeholder="Enter Your Name" required>

            <label>Reservation Date</label>
            <?php
                $today = date("Y-m-d");
                $max_date = date("Y-m-d", strtotime("+1 month"));
                echo '<input type="date" name="date" min="'.$today.'" max="'.$max_date.'" required>';
            ?>

            <label>Reservation Time</label>
            <input type="time" name="time" required>

            <button type="submit" name="reserve">Reserve Now</button>
        </form>
    </div>
</div>

</body>
</html>
<?php
include_once("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <script src="fontawesome/all.js"></script>
    <link rel="stylesheet" href="../asset/css/siderbar.css">
</head>
<body>
    <main>
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fa fa-arrow-right" id="open"></i>
        </label>
        <div class="sidebar">
            <div class="top">
                Sidebar
            </div>  
            <ul>
                <li><a class="#" href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a class="#" href="#"><i class="fa fa-shopping-basket"></i> Orders</a></li>
                <li><a class="#" href="#"><i class="fa fa-shopping-bag"></i> Products</a></li>
                <li><a class="#" href="#"><i class="fa fa-user-circle"></i> Profile</a></li>
            </ul>
        </div>
        <section>
        </section>
    </main>
</body>
</html>
<?php
session_start();

include('connection.php');

// Check if the request method is POST
if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header('Location:../404.php');
    
} 
else{
    include('index.php'); 
}
?>

   

<div class="sidebar">
        <div class="sidebar-header">
            Admin Panel
        </div>
        <ul class="sidebar-menu">
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#user-management">User Management</a></li>
            <li><a href="content.php">Content Management</a></li>
            <li><a href="#settings">Settings</a></li>
            <li><a href="#reports">Reports and Analytics</a></li>
            <li><a href="#security">Security</a></li>
            <li><a href="#maintenance">System Maintenance</a></li>
            <li><a href="#support">Help and Support</a></li>
        </ul>
    </div>

    <div class="main-content">
   
    <?php


?>
    </div>

    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #333;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidebar-header {
    padding: 10px 20px;
    color: #fff;
    font-size: 20px;
    text-align: center;
}

.sidebar-menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    padding: 10px 20px;
}

.sidebar-menu li a {
    display: block;
    color: #fff;
    text-decoration: none;
}

.sidebar-menu li a:hover {
    background-color: #555;
}

.main-content {
    margin-left: 250px; /* Same width as the sidebar */
    padding: 20px;
}
    </style>

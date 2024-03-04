<?php
// Include connection file

include('function.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submissions here
}

// Query to fetch existing content from the database
// Example query: $query = "SELECT * FROM content";
// Execute the query and fetch the results
// Example result: $results = $conn->query($query);
// Loop through $results to display existing content

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management</title>
    <!-- Add your CSS stylesheets or Bootstrap -->
</head>
<body>

<!-- Display your content here -->
<div class="container">
    <h1>Content Management</h1>
    
    <!-- Form for inserting data -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Add Data</h2>
        <input type="text" name="data" placeholder="Enter data">
        <input type="hidden" name="action" value="insert">
        <button type="submit">Add</button>
    </form>

    <!-- Form for updating data -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Update Data</h2>
        <input type="text" name="id" placeholder="Enter ID to update">
        <input type="text" name="data" placeholder="Enter updated data">
        <input type="hidden" name="action" value="update">
        <button type="submit">Update</button>
    </form>

    <!-- Form for deleting data -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Delete Data</h2>
        <input type="text" name="id" placeholder="Enter ID to delete">
        <input type="hidden" name="action" value="delete">
        <button type="submit">Delete</button>
    </form>
</div>
<style>


        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        /* Style for action buttons */
        .action-btns {
            margin-bottom: 20px;
            text-align: center;
        }

        .action-btns button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for content table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</body>
</html>

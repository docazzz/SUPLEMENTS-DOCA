<?php 
include("connection.php");

$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["Username"]);
    $password = trim($_POST["Password"]);

    if (empty($username)) {
        $username_err = "Username is required";
    }

    if (empty($password)) {
        $password_err = "Password is required";
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT ID, Username, Password, usertype FROM user WHERE Username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashed_password = $row["Password"];

                if (password_verify($password, $hashed_password)) {
                    // Password is correct, check user type
                    $user_type = $row["usertype"];
                    if ($user_type == "admin") {
                        // Admin user, redirect to admin.php
                        header("Location:../SAJTPHP1/admin.php");
                    } else {
                        // Regular user, redirect to index.php
                        header("Location:../SAJTPHP1/index.php?uspeh=1");
                    }
                    exit();
                } else {
                    // Display an error message if password is not valid
                    $password_err = "Invalid password";
                }
            } else {
                // Display an error message if username doesn't exist
                $username_err = "User not found";
            }
        } else {
            // Log database execution error
            error_log("Error executing database query: " . json_encode($stmt->errorInfo()));
            echo "Oops! Something went wrong. Please try again later.";
        }

        unset($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login</title>
   
<h2>User Login</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="Username" value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : ''; ?>">
        <span class="error"><?php echo $username_err; ?></span>
    </div>
    <div>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="Password">
        <span class="error"><?php echo $password_err; ?></span>
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
</form>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
           
            margin-right:140px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
      

   
</body>
</html>

<?php
// Include the database connection file
include('connection.php');

// Initialize variables for form data and error messages
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = $register_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username is required";
    } else {
        $username = trim($_POST["username"]);
        // Check if username already exists
        $sql = "SELECT ID FROM user WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetch()) {
            $username_err = "Username already exists";
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        // Check if email already exists
        $sql = "SELECT ID FROM user WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetch()) {
            $email_err = "Email already exists";
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Password is required";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Passwords do not match";
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database using prepared statement
        $sql = "INSERT INTO user (Username, password, Email) VALUES (?, ?, ?)";
        $conn->beginTransaction();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $conn->commit();
            // Redirect to index.php after successful registration
            header("Location: index.php");
            exit();
        } else {
            $conn->rollBack();
            $register_err = "Registration failed. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Registration</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h2>User Registration</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $username_err; ?></span>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $email_err; ?></span>
    </div>
    <div>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>">
        <span class="error"><?php echo $password_err; ?></span>
    </div>
    <div>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>">
        <span class="error"><?php echo $confirm_password_err; ?></span>
    </div>
    <div>
        <input type="submit" value="Register">
    </div>
    <span class="error"><?php echo $register_err; ?></span>
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

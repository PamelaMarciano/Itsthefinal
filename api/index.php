<!DOCTYPE html>
<html>
<head>
    <title>Applicants Verify Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        form {
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type=text] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type=submit] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Applicants Verify Management</h2>
        <form action="generate.php" method="post">
            <label for="appName">Applicant Name:</label>
            <input type="text" id="appName" name="appName" required><br><br>
            
            <input type="submit" name="action" value="Generate Keys">
            <input type="submit" name="action" value="Verify Record">
        </form>
    </div>
</body>
</html>
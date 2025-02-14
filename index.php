<!-- filepath: /var/www/html/php_course/index.php -->
<?php
function saveFormData($data) {
    $file = 'users.txt';
    $current = file_get_contents($file);
    $current .= implode(",", $data) . "\n";
    file_put_contents($file, $current);
}

function getFormData() {
    $file = 'users.txt';
    $data = file($file, FILE_IGNORE_NEW_LINES);
    $users = array_map(function($line) {
        return explode(",", $line);
    }, $data);
    return $users;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formData = [
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['track'],
        isset($_POST['courses']) ? implode(" ", $_POST['courses']) : "None selected",
        $_POST['comments']
    ];
    saveFormData($formData);
}

$users = getFormData();
?>
<html>
<head>
    <title>PHP Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Track</th>
            <th>Courses</th>
            <th>Comments</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user[0]; ?></td>
            <td><?php echo $user[1]; ?></td>
            <td><?php echo $user[2]; ?></td>
            <td><?php echo $user[3]; ?></td>
            <td><?php echo $user[4]; ?></td>
            <td><?php echo $user[5]; ?></td>
            <td><?php echo $user[6]; ?></td>
            <td><?php echo $user[7]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
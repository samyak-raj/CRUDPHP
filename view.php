<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }
        img{
            height: 100px;
            width: 100px;
        }
        
    </style>
</head>
<body>
   <table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Dob</th>
        <th>Address</th>
        <th>Hobby</th>
        <th>Age</th>
        <th>Picture</th>
        <th>Cv</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    include 'dbconnect.php';
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['Id']?></td>
                <td><?php echo $row['Name']?></td>
                <td><?php echo $row['Email']?></td>
                <td><?php echo $row['Gender']?></td>
                <td><?php echo $row['Dob']?></td>
                <td><?php echo $row['Address']?></td>
                <td><?php echo $row['Hobby']?></td>
                <td><?php echo $row['Age']?></td>
                <td>
                    <img src="<?php echo $row['Picture']?>" alt="">
                </td>
                <td>
                    <a href="<?php echo $row['Cv']?>"> View Cv</a>
                </td>
                <td>
                    <button><a href="update.php?Id=<?php echo $row['Id']?>">Update</a></button>
                </td>
                <td>
                    <button><a href="delete.php?Id=<?php echo $row['Id']?>">Delete</a></button>
                </td>
            </tr>
            <?php
        }
    } 
    
    ?>

   </table> 
</body>
</html>
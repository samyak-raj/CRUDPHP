<?php
include 'dbconnect.php';
$Id = $_GET['Id'];
$sql = "SELECT * FROM student WHERE Id='$Id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$Hobby = explode(',', $row['Hobby']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
        img {
            height: 200px;
            width: 200px;
        }
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
       Name: 
       <input type="text" name="Name" id="" value="<?php echo $row['Name']?>"> 
       <br>
       <br>

       Email:
       <input type="email" name="Email" id="" value="<?php echo $row['Email']?>"> 
       <br>
       <br>

       Age:
       <input type="number" name="Age" id="" value="<?php echo $row['Age']?>">
       <br>
       <br>

       Gender:
       <input type="radio" name="Gender" id="" value="Male" 
       <?php if ($row['Gender'] == 'Male') {
            echo "checked";
       }
        ?>
        >Male

       <input type="radio" name="Gender" id="" value="Female"
       <?php if ($row['Gender'] == 'Female') {
            echo "checked";
       }
        ?>
       >Female
       <br><br>

       DOB: 
       <input type="date" name="Dob" id="" value="<?php echo $row['Dob']?>"> 
       <br><br>
       Address:
       <select name="Address" id="">
        <option value="Lalitpur" 
        <?php
            if ($row['Address'] == 'Lalitpur'){
                echo "selected";
            }
        ?>
        >Lalitpur</option>

        <option value="Kathmandu"
        <?php
            if ($row['Address'] == 'Kathmandu'){
                echo "selected";
            }
        ?>
        >Kathmandu</option>

        <option value="Imadole" 
        <?php
            if ($row['Address'] == 'Imadole'){
                echo "selected";
            }
        ?>

        >Imadole</option>
       </select>
       <br><br> 

       Hobbies:
       <input type="checkbox" name="Hobby[]" id="" value="Coding" <?php echo in_array('Coding', $Hobby) ? 'checked' : '' ?>>Coding
       <input type="checkbox" name="Hobby[]" id="" value="Guitar" <?php echo in_array('Guitar', $Hobby) ? 'checked' : '' ?>>Guitar 
       <input type="checkbox" name="Hobby[]" id="" value="Dance" <?php echo in_array('Dance', $Hobby) ? 'checked' : '' ?>>Dance
       <br><br>

       Image:
       <input type="file" name="Image" id="" accept="Image/*" value="<?php echo $row['Picture']?>">
        <br><br>
        <img src="<?php echo $row['Picture']?>" alt="">

       <br><br>

       CV:
       <input type="file" name="Cv" id="" value="<?php echo $row['Cv']?>">
       <br><br>
        <a href="<?php echo $row['Cv']?>">View CV<a>
        <br><br>
        
       <input type="submit" value="submit"  name="Submit">
       <br><br>
       
    </form>
    <button onclick="location.href='view.php';">view Database</button>
    <?php
include 'dbconnect.php';
    if(isset($_POST['Submit'])) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Gender = $_POST['Gender'];
        $Dob = date('Y-m-d', strtotime($_POST['Dob']));
        $Address = $_POST['Address'];
        $Hobby = implode(',', $_POST['Hobby']);
        $Age = $_POST['Age'];

        // Handle Image upload
        if (!empty($_FILES['Image']['name'])) {
            $pic = $_FILES['Image']['name'];
            $temp1 = $_FILES['Image']['tmp_name'];
            $folder1 = 'Pic/' . $pic;
            move_uploaded_file($temp1, $folder1);
        } else {
            $folder1 = $row['Picture']; // Keep the existing image
        }

        // Handle CV upload
        if (!empty($_FILES['Cv']['name'])) {
            $pic = $_FILES['Cv']['name'];
            $temp2 = $_FILES['Cv']['tmp_name'];
            $folder2 = 'Cv/' . $pic;
            move_uploaded_file($temp2, $folder2);
        } else {
            $folder2 = $row['Cv']; // Keep the existing CV
        }

        // Update query
        $sql = "UPDATE student 
                SET Name='$Name', 
                    Email='$Email', 
                    Age='$Age', 
                    Gender='$Gender', 
                    Dob='$Dob', 
                    Address='$Address', 
                    Hobby='$Hobby', 
                    Picture='$folder1', 
                    Cv='$folder2' 
                WHERE Id='$Id'";

        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script>alert('Success')</script>";
            echo "<script>location.href = 'view.php'</script>";
        } else {
            echo "<script>alert('Failed')</script>". mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include_once './connection.php';

    echo "<link rel='stylesheet' type='text/css' href='style/style.css?v=" . time() . "'>"; // remove the caching 


    if(isset($_POST['submit'])){
        $sid = $_POST['staff_id'];
        $email = $_POST['email'];
        $name = $_POST['name'];

        $query = "UPDATE staff SET name='$name' , email='$email' WHERE sid='$sid'";
        
        if(mysqli_query($connection,$query)){
            header("Location: index.php");
            exit();
        }else{
            echo "<script> window.alert('update fail')</script>";
        }
    }


?>

<header>
    <h3>Practical Examination - SENG 21253 - 2023</h3> <br/>
    <h3>SE/2021/011</h3>
</header>

<?php
    echo "<div id='main-div'>";
        if(isset($_GET['sid'])){
            $staff_id = (string) $_GET['sid'];

            echo "<h4>Edit Course Information - $staff_id </h4><br/>";

            $query = "SELECT * FROM staff WHERE sid='$staff_id'";

            $data_array = mysqli_query($connection, $query);

            if(mysqli_num_rows($data_array)>0){
                $data = mysqli_fetch_assoc($data_array);
                $name = $data['name'];
                $email = $data['email'];

                echo "<form action='' method='post'>
                        <input type='hidden' value='$staff_id' name='staff_id' />
                        <lable> Course Title </lable>
                        <input type='text' name='name' value='$name' />
                        <br/><br/>
                        <lable>Course hours</lable>
                        <input type='text' name='email' value='$email' />
                        <br/><br/>
                        <button type='submit' name='submit'>Update Details</button>
                
                      </form>";
            }
        }
    echo "</div>";

?>
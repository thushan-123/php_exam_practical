<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include_once './connection.php';

    echo "<link rel='stylesheet' type='text/css' href='style/style.css?v=" . time() . "'>"; // remove the caching 


    if(isset($_POST['submit'])){
        $cid = $_POST['course_id'];
        $title = $_POST['course_title'];
        $hours = $_POST['course_hours'];

        $query = "UPDATE course SET title='$title' , hours='$hours' WHERE cid='$cid'";
        
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
        if(isset($_GET['cid'])){
            $course_id = (string) $_GET['cid'];

            echo "<h4>Edit Course Information - $course_id </h4><br/>";

            $query = "SELECT * FROM course WHERE cid='$course_id'";

            $data_array = mysqli_query($connection, $query);

            if(mysqli_num_rows($data_array)>0){
                $data = mysqli_fetch_assoc($data_array);
                $title = $data['title'];
                $hours = $data['hours'];

                echo "<form action='' method='post'>
                        <input type='hidden' value='$course_id' name='course_id' />
                        <lable> Course Title </lable>
                        <input type='text' name='course_title' value='$title' />
                        <br/><br/>
                        <lable>Course hours</lable>
                        <input type='text' name='course_hours' value='$hours' />
                        <br/><br/>
                        <button type='submit' name='submit'>Update Details</button>
                
                      </form>";
            }
        }
    echo "</div>";

?>
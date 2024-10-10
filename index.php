<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include_once './connection.php';

    echo "<link rel='stylesheet' type='text/css' href='style/style.css?v=" . time() . "'>"; // remove the caching 


?>

<header>
    <h3>Practical Examination - SENG 21253 - 2023</h3> <br/>
    <h3>SE/2021/011</h3>
</header>

<?php

    // get the course detail

    $query = "SELECT * FROM course ";

    $course_data = mysqli_query($connection,$query);

    $courses = [];

    echo "<div id='main-div'> 
         <h4> Course Details </h4>";

    echo "<table border=0> 
                <tr>
                    <th>Course code</th>
                    <th>Course title</th>
                    <th>Duration</th>
                    <th></th>
                </tr>
        ";
            if(mysqli_num_rows($course_data)>0){
                while($row = mysqli_fetch_assoc($course_data)){
                    $course_code = $row['cid'];
                    $course_title = $row['title'];
                    $hours = $row['hours'];

                    $courses[] = $row;

                    echo "<tr>
                                <td>$course_code</td>
                                <td>$course_title</td>
                                <td>$hours</td>
                                <td><a href='course.php?cid=$course_code'>Edit</a></td>
                          </tr>";
                }
            }

    echo "</table></div>";


    // get the staff detail

    $query = "SELECT * FROM staff ";

    $result = mysqli_query($connection,$query);

    echo "<div id='main-div'> 
         <h4> Staff Details </h4>";

    echo "<table border=0> 
                <tr>
                    <th>Course code</th>
                    <th>Course title</th>
                    <th>Duration</th>
                    <th></th>
                </tr>
        ";
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $sid = $row['sid'];
                    $name = $row['name'];
                    $email = $row['email'];

                    echo "<tr>
                                <td>$sid</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td><a href='staff.php?sid=$sid'>Edit</a></td>
                          </tr>";
                }
            }

    echo "</table></div>";

    // show course - staff details

    echo "<div id='main-div'> <h4>Course - Staff Details</h4>";

            if(count($courses)>0){
                foreach($courses as $row){
                    $course_code = $row['cid'];
                    $course_title = $row['title'];
                    $hours = $row['hours'];

                    echo "<br/><div>
                            <h4>$course_code - $course_title ($hours hours)</h4> <br/>
                            <p>Lecture Panal<a href='panel.php?cid=$course_code'>Edit</a></p> <br/>

                            <table>
                                <tr>
                                    <th>Staff Id</th>
                                    <th>Name</th>
                                    <th>email</th>
                                </tr>
                        ";
                        $query = "SELECT * FROM staff WHERE sid in (SELECT sid from conduct WHERE cid='$course_code')";
                        $staff_data = mysqli_query($connection,$query);

                        if(mysqli_num_rows($staff_data)>0){
                            while($row = mysqli_fetch_assoc($staff_data)){
                                $id = $row['sid'];
                                $name = $row['name'];
                                $email = $row['email'];

                                echo "<tr>
                                        <td>$id</td>
                                        <td>$name</td>
                                        <td>$email</td>
                                    </tr>";
                            }
                        }
                        
                    echo "</table></div>";
                }
            }

    echo "</div>";
    


?>
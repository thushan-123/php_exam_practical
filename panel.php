<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include_once './connection.php';

    echo "<link rel='stylesheet' type='text/css' href='style/style.css?v=" . time() . "'>"; // remove the caching 

    if(isset($_POST['submit'])){
        $cid = $_POST['cid'];
        $lectures = $_POST['lectures'];

        // delete all having given cid after add new data

        $delete_query = "DELETE FROM conduct WHERE cid='$cid'";

        if(mysqli_query($connection,$delete_query)){
            foreach($lectures as $lecture){

                $insert_query = "INSERT INTO conduct(cid,sid) VALUES ('$cid','$lecture')";
                mysqli_query($connection,$insert_query);
            }
            header("Location: index.php");
        }
    }


?>

<header>
    <h3>Practical Examination - SENG 21253 - 2023</h3> <br/>
    <h3>SE/2021/011</h3>
</header>


<?php

    // get the staff details

    if(isset($_GET['cid'])){

        $cid = (string) $_GET['cid'];

        $query = "SELECT * FROM staff";

        $result_set = mysqli_query($connection,$query);

        echo "<div id='main-div'>
            <h4> Add/Remove Staff to Course - $cid</h4><br/><br/>
            <form action='' method='post'>
            ";
            
            if(mysqli_num_rows($result_set)>0){
                while($row = mysqli_fetch_assoc($result_set)){
                    $sid = $row['sid'];
                    $name = $row['name'];

                    $check_query ="SELECT * FROM conduct WHERE cid='$cid' AND sid='$sid'";

                    $result = mysqli_query($connection,$check_query);

                    if (mysqli_num_rows($result) >0 ){
                        echo "<input type='checkbox' name='lectures[]' value='$sid' checked/>
                        <lable> $name</lable><br/><br/>
                        ";
                        
                    }else{
                        echo "<input type='checkbox' name='lectures[]' value='$sid' />
                        <lable> $name</lable><br/><br/>
                        ";
                    }

                    

                }

            }

        echo "<input type='hidden' name='cid' value='$cid' />
            <button type='submit' name='submit'>Update Details</button>
            </form></div>";
    }
    

?>
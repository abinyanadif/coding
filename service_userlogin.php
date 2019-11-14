<?php   
    $conn = new mysqli('localhost', 'root', '');  
    mysqli_select_db($conn, 'EmployeeDB');  
    if (isset($_GET['username']) && $_GET['username'] != '' &&isset($_GET['password']) && $_GET['password'] != '')   
    {  
        $email = $_GET['username'];  
        $password = $_GET['password'];   
  
        $getData = "SELECT `ur_Id`,`ur_username`,`ur_password` FROM `tbl_user` WHERE `ur_username`='" .$email."'  
        and `ur_password`='".$password."'";  
  
        $result = mysqli_query($conn,$getData);  
  
        $userId="";  
        while( $r = mysqli_fetch_row($result))  
        {  
            $userId=$r[0];  
        }  
  
        if ($result->num_rows> 0 ){  
  
            $resp["status"] = "1";  
            $resp["userid"] = $userId;  
            $resp["message"] = "Login successfully";  
        }  
        else{  
            $resp["status"] = "-2";  
            $resp["message"] = "Enter correct username or password";  
        }  
  
    }  
    else  
    {  
  
        $resp["status"] = "-2";  
        $resp["message"] = "Enter Correct username.";  
  
  
    }  
  
    header('content-type: application/json');  
  
    $response["response"]=$resp;  
    echo json_encode($response);  
  
    @mysqli_close($conn);  
  
/*

MEMBUAT TABEL TBL_USER 

CREATE TABLE IF NOT EXISTS `tbl_user` (  
  `ur_Id` int(11) NOT NULL AUTO_INCREMENT,  
  `ur_username` varchar(50) NOT NULL,  
  `ur_password` varchar(50) NOT NULL,  
  `ur_status` int(11) NOT NULL,  
  PRIMARY KEY (`ur_Id`)  
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  

INSERT INTO `tbl_user` (`ur_Id`, `ur_username`, `ur_password`, `ur_status`) VALUES  
(1, 'nirav@gmail.com', 'nirav', 1),  
(2, 'kapil@gmail.com', 'kapil', 1),  
(3, 'arvind@gmail.com', 'arvind', 1); 

*/

?>


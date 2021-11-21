<?php
if(!empty($_POST['l_name']) AND !empty($_POST['l_qty']) AND !empty($_POST['l_price']) AND !empty($_POST['sum'])) {
    //1. Get the Data from form


        //Create Constants to Store Non Repeating Values
        define('SITEURL', 'http://localhost:8000/');
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'userthut');
        define('DB_PASSWORD', 'thut');
        define('DB_NAME', 'foodorder');
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database
    
    $l_name = $_POST['l_name'];
    $l_qty = $_POST['l_qty'];
    $l_price = $_POST['l_price'];
    $sum = $_POST['sum'];
    $l_qty = $_POST['l_qty'];
    $order_date =date('Y-m-d H:i:s');
    $t_id=time();

//Process the Value from Form and Save it in Database

        // //2. SQL Query to Save the data into database

         for ($x = 0; $x < sizeof($l_qty); $x++) {
             $sql = "INSERT INTO tbl_order SET 
             id='$t_id',
             food='$l_name[$x]',
             price='$l_price[$x]',
             qty='$l_qty[$x]',
             total = '$sum',
             order_date='$order_date'
         ";
  

         
        

         //3. Executing Query and Saving Data into Datbase
         $res = mysqli_query($conn, $sql) or die(mysqli_error());
         
               

          //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
          if($res==TRUE)
          {
              //Data Inserted
              //echo "Data Inserted";
              //Create a Session Variable to Display Message
              //Redirect Page to Manage Admin
              //header("location:".SITEURL.'admin/manage-admin.php');
              
          }
          else
          {
              //FAiled to Insert DAta
              //echo "Faile to Insert Data";
              //Create a Session Variable to Display Message
              //Redirect Page to Add Admin
              //header("location:".SITEURL.'admin/add-admin.php');
              echo('insert fail');
          }
  

          } echo(200);
         
}



    


?>


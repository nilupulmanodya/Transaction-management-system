<?php include('config/constants.php'); ?>
<html>
<head>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="js/jquery.js"></script>
<script src="js/scriptIndex.js"></script>
<title>
</title>

<style>
    * {
      box-sizing: border-box;
    }
    
    /* Create two unequal columns that floats next to each other */
    .column {
      float: left;
      padding: 10px;
       /* Should be removed. Only for demonstration */
    }
    
    .left {
      width: 65%;
    }
    
    .right {
      width: 35%;
    }
    
    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Naiwala Resturent</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="#">Order History</a>
          </li>
        </ul>
        <span class="navbar-text">
          
          <a class="nav-link" href="/admin.php">Login as Admin</a>
        </span>
      </div>
    </div>
  </nav>
</head>
<body>



<div class="row">
  <div class="column left" style="background-color:#aaa;">
    <h3 style="text-align: center;">Menu</h3>

    <nav class="navbar navbar-light bg-light">
        <form class="container-fluid justify-content-start">

        <button class="btn btn-sm btn-outline-secondary" style="margin-right: 3px;" type="button">All</button>

<?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        <button class="btn btn-sm btn-outline-secondary" style="margin-right: 3px;" type="button"><?php echo $title; ?></button>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>
        </form>
    </nav>
      
  
    <div class="row" style="margin:auto;" >




    <!-- fOOD MEnu Section Starts Here -->

            <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>                 
                
                            <button id="<?php echo $id; ?>" value="<?php echo $title; ?>,<?php echo $price; ?>" onclick="disableButton('<?php echo $id; ?>')" class="add-row btn btn-sm btn-outline-secondary" style="width:18%; margin:8px 8px ; height:180px; border:1px solid rgb(131, 131, 131); color: black;">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Alter text" style="height: 65%; width:90%; margin: auto; padding: 2px;">

                                        <?php
                                    }
                                ?>                                
                                        <h8><?php echo $title; ?></h8>
                                        <p><?php echo $price; ?></p>
                        <?php
                    }
                }
                else
                {
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>  
     
    </div>
  </div>
    
  
  <div class="column right" style="background-color:#bbb;">
    <h3 style="text-align: center;">Cart</h3>
    <form>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Reference Note</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Only admin can see this.</div>
      </div>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Quentity</th>
            <th scope="col">Price (Rs)</th>
            <th scope="col">Remove</th>
          </tr>
        </thead>
          
        
        <tbody>
          
        </tbody>
      </table>

      <button type="button" id="cal_sum"class="btn btn-primary">Calculate Total</button>
      <br><br>
      <table>
        <tr>
          <th >TOTAL(Rs)</th>
          <th class="sum">0.00</th>
        </tr>
        <tr>
          <td><button  class="btn btn-primary">Pay Now</button></td>
          <td><button type="button"  onclick='refreshPage()' id="clearAll" class="btn btn-primary">Refresh</button></td>
        </tr>
       </table>
    </form>
  </div>
</div>


<!--JS libraries-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--Footer-->
<div style="background-color: blue;"><h3>All Right reseirved</h3></div>

 
</body>
  </html>
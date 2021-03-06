<?php include('config/constants.php'); ?>
<html>
<head>
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>



<script src="js/scriptIndex.js"></script>
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
            <a class="nav-link" href="order_history_today.php">Today Transactions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order_history.php">Order History</a>
          </li>
        </ul>
        <span class="navbar-text">
          
          <a class="nav-link" href="/admin/">Login as Admin</a>
        </span>
      </div>
    </div>
  </nav>
</head>
<body>



<div class="row">
  <div class="column left" style="background-color:#aaa;">
    <h3 style="text-align: center;">Menu</h3>
    <div id="tabs">
    <nav class="navbar navbar-light bg-light">        
            <ul><li class="btn btn-sm btn-outline-secondary" style="margin-right: 3px;" type="button"><a href="#tabs-all">All</a></li>
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
                                        <li class="btn btn-sm btn-outline-secondary" style="margin-right: 3px;" type="button"><a href="#tabs-<?php echo $id ?>"><?php echo $title; ?></a></li>
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
                            
                            ?>
                            </ul>
    </nav>
      
  
    <div id="tabs-all" class="row" style="margin:auto;" >

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
                
                            <button id="<?php echo $id; ?>" value="<?php echo $title; ?>,<?php echo $price; ?>" onclick="disableButton('<?php echo $id; ?>')" class="<?php echo $id; ?> add-row btn btn-sm btn-outline-secondary" style="width:18%; margin:8px 8px ; height:180px; border:1px solid rgb(131, 131, 131); color: black;">
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
     
    


   
-------------------
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
                                      ?>
                                      <div id="tabs-<?php echo $id?>" class="row" style="margin:auto;" >
                                      <?php
                                      //Display Foods that are Active
                                      $sql3 = "SELECT * FROM tbl_food WHERE active='Yes' AND category_id=$id";
                                      //Execute the Query
                                      $res3=mysqli_query($conn, $sql3);
                                      //Count Rows
                                      $count3 = mysqli_num_rows($res3); 
                                      //CHeck whether the foods are availalable or not
                                      if($count3>0)
                                      {
                                          //Foods Available
                                          while($row3=mysqli_fetch_assoc($res3))
                                          {
                                                //Get the Values
                                                $id = $row3['id'];
                                                $title = $row3['title'];
                                                $description = $row3['description'];
                                                $price = $row3['price'];
                                                $image_name = $row3['image_name'];
                                                ?>                 
            
                                                <button id="<?php echo $id; ?>" value="<?php echo $title; ?>,<?php echo $price; ?>" onclick="disableButton('<?php echo $id; ?>')" class="<?php echo $id; ?> add-row btn btn-sm btn-outline-secondary" style="width:18%; margin:8px 8px ; height:180px; border:1px solid rgb(131, 131, 131); color: black;">
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
                                           ?>
                                      </div>
                                      <?php
                                        }
                                        else
                                        {
                                          //Food not Available
                                          echo "<div class='error'>Food not found.</div>";
                                        }
                                      }
                                      
                                  }
                                  else
                                  {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                  }
                            
                            ?>
---------------

</div>
 
        </div>
    </div>
  </div>
    







  
  
  <div class="column right" style="background-color:#bbb;">
    <h3 style="text-align: center;">Cart</h3>
    <form>
      

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
          <td>
        
          <button id="check_bl" type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">
              Pay Now
            </button>  
        
        </td>



          <td>
          <button id="myModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#refreshModel">
            Refresh
          </button>  
                    
          
        </tr>
       </table>
    </form>
  </div>
</div>



<!--Footer-->





<!-- Modal for confirm refresh -->
<div class="modal fade" id="refreshModel" tabindex="-1" role="dialog" aria-labelledby="refreshModel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="refreshModel">Are you sure to refresh?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        After refreshing all the data of the cart will be removed... 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" onclick='refreshPage()' class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal for confirm payment-->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModal">Are you sure to generate bill ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id='modeltable'> 
          <thead>
                <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Item Name
                    </th>
                    <th>
                      Quantity
                    </th>
                    <th>
                      price(Rs)
                    </th>
                  <tr>
                <tr>

          </thead>
              <tbody>
              </tbody>
                
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button id='btn_payment_confirm' type="button" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>


<!--
<div id="tabs">
sdgdsg sadg
  <ul>
    <li><a href="#tabs-a">Nunc tincidunt</a></li>
    <li><a href="#tabs-b">Proin dolor</a></li>
    <li><a href="#tabs-3">Aenean lacinia</a></li>
  </ul>
  <div id="tabs-a">
    <p>Proin elit.</p>
  </div>
  <div id="tabs-b">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis.</p>
  </div>
  <div id="tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congueendrerit hendrerit.</p>
  </div>
</div>

-->
<div style="background-color: blue;"><h3>All Right reseirved</h3></div>

 
</body>
  </html>

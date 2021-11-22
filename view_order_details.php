<?php include('config/constants.php'); ?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>




<script src="js/jquery.js"></script>
<script src="js/scriptIndex.js"></script>
<style>
table, td {
  border: 1px solid black;
}
th{
    
    position: -webkit-sticky;
    position: sticky;
    top: 0px;
    z-index: 50;
    background: white;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
    </head>
    <body>
        <a href="">back to menu</a><br>
        <a href="">back to order history</a>
        <br>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Date Time</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Receipt</th>
            </tr>
          <?php

//Display Foods that are Active
                $sql = "SELECT * FROM tbl_order WHERE id=1636314928";

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
                        $order_date = $row['order_date'];
                        $price = $row['price'];
                        $food = $row['food'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        ?>                 
                

                <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $order_date ?></td>
                <td><?php echo $food ?></td>
                <td><?php echo $price ?></td>
                <td><?php echo $qty ?></td>
                <td><?php echo $total ?></td>
                <td><button class="btn btn-sm btn-outline-danger" style="margin-right: 3px;" id="<?php echo $id; ?>">Print</button></td>

            </tr>
<?php
                    }}
                                              
                
                else
                {
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>  



        </table>
    </body>
</html>
<?php
?>
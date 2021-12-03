  $(document).ready(function(){
      $(".add-row").on('click ',function(){
          var btn_data = $(this).val().split(',');
          var name = btn_data[0]
          var price = btn_data[1]
          var btn_id = this.id;
          //console.log(btn_id);
          
          var markup = "<tr class='tr22'><th>"+btn_id+"</th><td><input class='fd_name' type='hidden' value='"+ name +"'>" + name + "</td><td><input class='quantity' onchange='cals();' type='number' size='2' required value='0' name='record'></td><td><input class='price' type='hidden' value="+price+">" + price + " </td>"+"<td>" +
        "<button id="+btn_id+" type='button' onclick='productDelete(this); ' class='btn delete-row btn-outline-danger'> Remove</button>" +
        "</td>"+"</tr>";



               $(".table tbody").append(markup);
        });


        


        $(".table input").on('change blur input', function () {
                var row = $(this).closest('tr'),
                quantity = row.find('.quantity').val(),
                price = parseFloat(row.find('.price').text());

            row.find('.total').text(quantity * price);

            var sum = 0;
            $('.total').each(function () {
                sum += parseFloat($(this).text()) || 0;
            });

            $('.sum').text(sum);
        });



        $("#cal_sum").click(function(){

          var sum=0;
          
          $(".tr22").each(function(){
            //console.log(sum);
            qty = ($(this).find('.quantity').val());
            price = ($(this).find('.price').val());

            //console.log(qty);
            //console.log(price);
            sum = parseFloat(sum + (qty*price));
            
            //alert(sum);
          });
          $('.sum').text(sum);

          
        });

        $("#check_bl").click(function(){

            var sum=0;
            const l_name=[];
            const l_price=[];
            const l_qty =[];
            
            $(".tr22").each(function(){
              //console.log(sum);
              name = ($(this).find('.fd_name').val());
              l_name.push(name);
              qty = ($(this).find('.quantity').val());
              l_qty.push(qty);
              price = ($(this).find('.price').val());
              l_price.push(price);
              sum = parseFloat(sum + (qty*price));

            });
            $('.sum').text(sum);
            ConfirmPay(l_qty,l_price,l_name,sum);


  



                $("#btn_payment_confirm").click(function(){     

                  //assigning values
                  var sum=0;
                  const l_name=[];
                  const l_price=[];
                  const l_qty =[];
                  
                  $(".tr22").each(function(){
                    //console.log(sum);
                    name = ($(this).find('.fd_name').val());
                    l_name.push(name);
                    qty = ($(this).find('.quantity').val());
                    l_qty.push(qty);
                    price = ($(this).find('.price').val());
                    l_price.push(price);
                    sum = parseFloat(sum + (qty*price));

      
                  });               
                    $.ajax({            
                        type : 'post',
                        datatype: 'json',
                        url : 'store_order.php',
                        data : {l_name : l_name, l_qty :l_qty,l_price:l_price,sum: sum},
                        success: function(response) {
                            if(response == 200) {
                              console.log(response);
                              alert('Error!');
                                
                                
                            } else {
                              
                                alert('Order added to DB');
                                print_receipt(response);
                                location.href = "/";

                              }
                        }}); 


                });
            
          });



          




function ConfirmPay(l_qty,l_price,l_name,sum){
  var markup2;

        $('#modeltable tbody').empty();

        for (let i = 0; i < l_qty.length; i++) {
          markup2 +="<tr><td>"+(i+1)+"</td><td>"+l_name[i]+"</td><td>"+l_qty[i]+"</td><td>"+l_price[i]+"</td><tr></tr>";
          
        } 
        markup2+="<tr><td></td><th>Total</th><td><td><th>"+sum+"</th></tr>";
        $("#modeltable tbody").append(markup2);
        

    }   
     
    
    
    
        

});

function refreshPage(){
    
        window.location.reload();
	}
    
function cals(){ 
    var sum=0;
    
    $(".tr22").each(function(){
      //console.log(sum);
      qty = ($(this).find('.quantity').val());
      price = ($(this).find('.price').val());

      //console.log(qty);
      //console.log(price);
      sum = parseFloat(sum + (qty*price));
      
      //alert(sum);
    });
    $('.sum').text(sum);
}

    
  function productDelete(ctl) {
        
         
        var btn_id = ctl.id;
        console.log(btn_id);
        
        //alert(btn_id);
        $(ctl).parents("tr").remove();
            enableButton(btn_id);
            //console.log("delete pressed");
            //console.log(btn_id);
            cals();
        }


  function disableButton(btn_id) {
        var btn = document.getElementsByClassName(btn_id);
        for(var i = 0; i < btn.length; i++) {
          //console.log(btn[i]);
          btn[i].disabled = true;}
        //btn.disabled = true;
        //btn.innerText = 'Posting...'
    }

    function enableButton(btn_id) {
        var btn = document.getElementsByClassName(btn_id);
        for(var i = 0; i < btn.length; i++) {
          //console.log(btn[i]);
          btn[i].disabled = false;}
        //btn.innerText = 'Posting...'
    }

    function view_order_details(btn_id) {
      //console.log(btn_id);
      location.href = "/view_order_details.php?id="+btn_id;}

      function print_receipt(btn_id) {
        //console.log(btn_id);
        //location.href = "/receipt.php?id="+btn_id;
        window.open("/receipt.php?id="+btn_id, "_blank");
        
}   


    

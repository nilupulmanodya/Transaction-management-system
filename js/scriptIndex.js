  $(document).ready(function(){
      $(".add-row").on('click ',function(){
          var btn_data = $(this).val().split(',');
          var name = btn_data[0]
          var price = btn_data[1]
          var btn_id = this.id;
          console.log(btn_id);
          
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
        var btn = document.getElementById(btn_id);
        btn.disabled = true;
        //btn.innerText = 'Posting...'
    }

    function enableButton(btn_id) {
        var btn = document.getElementById(btn_id);
        btn.disabled = false;
        //btn.innerText = 'Posting...'
    }


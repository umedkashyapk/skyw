<script>
    $(document).ready(function(){
        $('.get_method_advance_info').change(function (e) {
            var thisval=$(this).val();
            if(thisval=="prm"){
                $('#prm_types_section').css('display','block');
            }else{
                $('#prm_types_section').css('display','none');
            }
            //alert(thisval);
        });
        
        $('.get_method_info').on('change', function (e) {
            var thisval=$(this).val();
            //alert(thisval);
            var res_area=$(this).attr('data-responsearea');
              $.ajax({
                  type: "post",
                  url: "<?= $panel_path.'payments/options_by_payment_type';?>",
                  data: {p_type:thisval},          
                  success: function (response) {  
                    //alert(response);
                    var res = JSON.parse(response);          
                    if(res.error==true){
                      $('#'+res_area).html(res.message);              
                    }else{
                      $('#'+res_area).html(res.message);              
                    }
                  }
                });
        });
        
        $('.payment_option_details').on('change', function (e) {
            var thisval=$(this).val();
            //alert(thisval);
            var res_area=$(this).attr('data-responsearea');
              $.ajax({
                  type: "post",
                  url: "<?= $panel_path.'payments/payment_option_details';?>",
                  data: {p_type:thisval},          
                  success: function (response) {  
                    //alert(response);
                    var res = JSON.parse(response);          
                    if(res.error==true){
                      $('#'+res_area).html(res.message);              
                    }else{
                      $('#'+res_area).html(res.message);              
                    }
                  }
                });
        });
            
    });    
</script>
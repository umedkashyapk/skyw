 <script>
    
  /*  $(".change_text_setting").change(function(){
          var slug=$(this).attr('data-slug');
          var res_area=$(this).attr('data-response');
          var val=$(this).val();
           
        $.ajax({
                type: "post",
                url: "<?= $admin_path.'settings/set_details';?>",
                data: {label:slug,value:val},          
                success: function (response) {
                    alert();
                   $('#'+res_area).html(response);
                }
              });
      });*/
    
        $('.change_text_setting').change(function(){
                var slug = $(this).attr('data-slug');
                var res_area = $(this).attr('data-response');
                var val = $(this).val();
               
            $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_details';?>",
              data: {label:slug,value:val},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
            });
        });
        
         
$('.change_radio_setting').change(function() {
    if ($(this).is(':checked')) {
      var vl=$(this).attr('data-on-text');
    }
    else {
       var vl=$(this).attr('data-off-text');
    }
    //alert(vl);
    var slug = $(this).attr('data-slug');
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_details';?>",
              data: {label:slug,value:vl},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
            });
  });
  
  
  $('.change_request_payments_setting').change(function() {
      
    if ($(this).is(':checked')) {
      var vl=$(this).attr('data-on-text');
    }
    else {
       var vl=$(this).attr('data-off-text');
    }
    var slug = $(this).attr('data-slug');
    //alert(vl);
    //die();
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_request_payment';?>",
              data: {label:slug,value:vl},          
              success: function (response) {  
                // alert(response);
                //$('#'+res_area).html(response);  
                
              }
            });
    });
  
  
  $('.change_wallet_setting').change(function() {
      
  
    if ($(this).is(':checked')) {
      var vl=$(this).attr('data-on-text');
    }
    else {
       var vl=$(this).attr('data-off-text');
    }
    var slug = $(this).attr('data-slug');
    // alert(slug);
    // die();
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_wallet_types';?>",
              data: {label:slug,value:vl},          
              success: function (response) {  
                alert(response);
                // $('#'+res_area).html(response);  
                
              }
            });
    });
  
  
  $('.change_payments_setting').change(function() {
    if ($(this).is(':checked')) {
      var vl=$(this).attr('data-on-text');
    }
    else {
       var vl=$(this).attr('data-off-text');
    }
    
    var slug = $(this).attr('data-slug');
    //alert(slug);
    //die();
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_payment';?>",
              data: {label:slug,value:vl},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
            });
  });
      
   $( "input[class=json_array_change]" ).on( "click", function(){
       var name_vr = $(this).attr('data-data_name');
       var cats = {};
        $. each($("input[name='"+name_vr+"']:checked"), function(){
            var _k = $(this). attr('data-key');
            var _v = $(this). attr('data-value');
            var obj = {};
            cats[_k] = _v;
            //cats.push(obj);
            //alert(_v);
        });
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_details';?>",
              data: {label:name_vr,value:cats},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
        });
    //return false;
    });   
      
   $('.change_admin_setting').change(function() {
    if ($(this).is(':checked')) {
      var vl='1';
    }
    else {
       var vl='0';
    }
    //alert(vl);
    var slug = $(this).attr('data-slug');
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_admin_status';?>",
              data: {label:slug,value:vl},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
            });
  });
  
  $( "input[class=multi_array_change]" ).on( "click", function(){
       var name_vr = $(this).attr('data-data_name');
       var cats = [];
        $. each($("input[name='"+name_vr+"']:checked"), function(){
            
            var _v = $(this). attr('data-value');
            cats.push(_v);
            //alert(_v);
        });
        $.ajax({
              type: "post",
              url: "<?= $admin_path.'settings/set_details';?>",
              data: {label:name_vr,value:cats},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
        });
    //return false;
    }); 
  
    </script>
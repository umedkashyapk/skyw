<script>
    
    $('#account_type').change(function (e) {
       // alert('test');
        var ths = $(this);
        
        var res_area = $(ths).attr('data-response');
        var blursection = $(ths).attr('data-blursection');
        var loader = $(ths).attr('data-loader');
        $('#'+blursection).css('filter','blur(8px)');
        $('#'+loader).css('display','block');
        //$("#"+res_area).html('<div class="loading"><center><img class="loading-image" src="<?= base_url('images/loader/ajax-loader.gif');?>"> </center></div>');
       // $('#'+res_area).html('<i class="fa fa-spinner fa-spin"></i>');
        var acc_type = $(this).val();  
        //alert(acc_type);
        $.ajax({
          type: "post",
          url: "<?= $admin_path.'payment/get_section';?>",
          data: {acc_type:acc_type},          
          success: function (response) {  
             // alert(response);
              $('#'+res_area).html(response);
              $('#'+blursection).css('filter','blur(0px)');
              $('#'+loader).css('display','none');
          }
        }); 
    });
</script>
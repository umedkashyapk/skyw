
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © <?= date('Y');?> <?= $this->conn->company_info('company_name');?>
        </div>
      </div>
    </footer>
 
   
  </div> 

 
  <script src="<?= $panel_url;?>assets/js/jquery.min.js"></script>
  <script src="<?= $panel_url;?>assets/js/popper.min.js"></script>
  <script src="<?= $panel_url;?>assets/js/bootstrap.min.js"></script>
 
	
	 
	
  <!-- simplebar js -->
  <script src="<?= $panel_url;?>assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="<?= $panel_url;?>assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="<?= $panel_url;?>assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="<?= $panel_url;?>assets/js/app-script.js"></script>

  <script src="<?= $panel_url;?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
  <script src="<?= $panel_url;?>assets/plugins/bootstrap-touchspin/js/bootstrap-touchspin-script.js"></script>

  <!--Select Plugins Js-->
  <!--<script src="<?= $panel_url;?>assets/plugins/select2/js/select2.min.js"></script>-->
  <!--Inputtags Js-->
  <script src="<?= $panel_url;?>assets/plugins/inputtags/js/bootstrap-tagsinput.js"></script>

  <!--Bootstrap Datepicker Js-->
  <script src="<?= $panel_url;?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo $panel_url;?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
    <script>
      $('#default-datepicker').datepicker({
        todayHighlight: true
      });
      $('#autoclose-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true
      });

      $('#inline-datepicker').datepicker({
         todayHighlight: true
      });

      $('#dateragne-picker .input-daterange').datepicker({
       });

    </script>
  
    
    
  <!-- Chart js -->
  <script src="<?= $panel_url;?>assets/plugins/Chart.js/Chart.min.js"></script>
  <!--Peity Chart -->
  <script src="<?= $panel_url;?>assets/plugins/peity/jquery.peity.min.js"></script>
  <!-- Index js -->
  <script src="<?= $panel_url;?>assets/js/index.js"></script>
  
    <script src="<?= $panel_url;?>assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <script src="<?= $panel_url;?>assets/js/widgets.js"></script>
    
    
  
   
    
    <!--Bootstrap Switch Buttons-->
    
    
    <script src="<?php echo $panel_url;?>assets/plugins/switchery/js/switchery.min.js"></script>
   <script>
      var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
      $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
       });
    </script>

    <!--Bootstrap Switch Buttons-->
    <script src="<?php echo $panel_url;?>assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
    <script>
    /* $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    }); */
    </script>
    
    
    
    <script src="<?php echo $panel_url;?>assets/plugins/jquery-multi-select/jquery.multi-select.js"></script>
    <script src="<?php echo $panel_url;?>assets/plugins/jquery-multi-select/jquery.quicksearch.js"></script>
   <script>
    
  /*  $(".change_text_setting").change(function(){
          var slug=$(this).attr('data-slug');
          var res_area=$(this).attr('data-response');
          var val=$(this).val();
           
        $.ajax({
                type: "post",
                url: "<?= $super_admin_path.'settings/set_details';?>",
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
              url: "<?= $super_admin_path.'settings/set_details';?>",
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
              url: "<?= $super_admin_path.'settings/set_details';?>",
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
              url: "<?= $super_admin_path.'settings/set_details';?>",
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
              url: "<?= $super_admin_path.'settings/set_admin_status';?>",
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
              url: "<?= $super_admin_path.'settings/set_details';?>",
              data: {label:name_vr,value:cats},          
              success: function (response) {  
                 
                //$('#'+res_area).html(response);  
                
              }
        });
    //return false;
    }); 
  
    </script>
   
</body>

</html>
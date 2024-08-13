 <?php
$ucd=$this->session->userdata('user_id');
$this->db->select('SUM(amount) as amnt,DATE(date) as date');
$this->db->where('tx_type','income');
$this->db->where('u_code',$ucd);
$this->db->group_by('DATE(date)');
$qr=$this->db->get('transaction');
$all_users=$qr->result_array();
$ids=!empty($all_users) ? array_column($all_users,'amnt'):array(0);
$lbl=!empty($all_users) ? array_column($all_users,'date'):array(0);


if(!empty($ids)){
    $data=json_encode($ids);
     
    $lebel=json_encode($lbl);
    //echo $data;
    ?>
    <canvas  id="dailychart"></canvas>
    <script>
    var ctx = document.getElementById('dailychart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
    
        // The data for our dataset
        data: {
            labels: <?= $lebel;?>,
            datasets: [{
                label: 'Total Income',
                backgroundColor: '#9dbed5',
              
                //borderColor: 'rgb(227, 243, 92)',
                data: <?= $data;?>
            }]
        },
    
        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Income Chart'
               
            }
        }
    });
</script>
    <?php
}

 
?>


<?php
$u_code=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($u_code);
$user_bank_detail=$this->conn->runQuery('*','user_accounts',"u_code='$u_code'");
$package_detail=$this->conn->runQuery('*','orders',"u_code='$u_code' and tx_type='purchase'");

?>
<div class="container pages">
    <div class="row pt-2 pb-2">
        <div class="col-sm-12">
        
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
                <li class="breadcrumb-item"><a href="#"> User Detail Form</a></li>            
                <li class="breadcrumb-item active" aria-current="page">User Detail Form </li>
            </ol>
        </div>
    <div class="col-sm-3">

    </div>
    </div>




<style>

    table {

    word-wrap: break-word;
    width: 100%;
    border:1px solid black;
    table-layout: inherit;
    table-layout: initial;

    }
    .invoice-box {
    max-width: 950px;
    margin: auto;
    padding: 20px;

    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    }

    .invoice-box table {
    width: 100%;
    line-height: inherit;

    }

    .invoice-box table td {
    padding: 5px;
    vertical-align: top;
    }

    .invoice-box table {
    width: 100%;
    line-height: inherit;

    }

    .invoice-box table td {

    vertical-align:top;
    }

    @media only screen and (max-width: 800px) {
    .invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
    }			
    }

    hr {
    border:none;
    color:#eee;
    background-color:#2E2F30;
    height:1px;
    width:20%;
    }



</style>


    <div id="DivIdToPrint"> 
        <div class="container">
                <div class="row">
                <div class="col-xs-10 col-sm-6 col-md-10 col-lg-10" style="color:black">
                <center>
                <a href="" class="btn btn-success" onclick='printDiv();' title="Print Form"><i class="fa fa-print"></i></a>
                </center>
                    <div class="card">
                        
                        <div class="card-body table-responsive">
                            
                            <table border="1" cellspacing="0" cellpadding="0">
                                <tbody>
                               
                                <tr class="top"><td colspan="15" valign="top" height="20px"><h2><center><?= $this->conn->company_info('company_name');?></h2></center></td></tr>					
                                <tr class="top"><td colspan="15" valign="top" height="20px"><center><?= $this->conn->company_info('company_address');?></center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px"><center>Ph. No. <?= $this->conn->company_info('company_mobile');?>, URL : <?= $this->conn->company_info('base_url');?>, E - mail : <?= $this->conn->company_info('company_email');?></center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>Promostional Business Associate (PBA) Application Form</center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px"><center>"Sponsored / Referral" Promostional Business Associate (PBA)</center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px"><center>"Sponsored / Referral" Independent Business Associate (IBA)</center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px">Sponsor:&nbsp;<?php
                                $check_existsspo=$this->conn->runQuery('id','users',"id='$profile->u_sponsor'");
                                if($check_existsspo){
                                   echo $this->profile->profile_info($profile->u_sponsor)->username;
                                }
                                ?></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px">Applicant's Full Name:&nbsp;&nbsp;<?= $profile->name;?></td></tr>
                                <tr class="top">
                                    <td colspan="2" valign="top" height="20px">Gender :&nbsp;&nbsp;
                                        <td colspan="2" valign="top" height="20px"><?= $profile->gender;?></td>
                                        <td colspan="11" valign="top" height="20px">Date of Birth (DD/MM/YYYY) :&nbsp;&nbsp;<?= $profile->dob;?></td>
                                    </td>
                                </tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px">S/o, D/o, W/o :&nbsp;&nbsp;<?= $profile->father_name;?> </td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="60px">Present Address :&nbsp;&nbsp;<?= $profile->address;?></td></tr>
                                <tr class="top">
                                    <td colspan="4" valign="top" height="20px">City :&nbsp;&nbsp;<?= $profile->city;?>
                                    <td colspan="11" valign="top" height="20px">State:&nbsp;&nbsp;<?= $profile->state;?></td>

                                </td>
                                </tr> 
                                <tr class="top"><td colspan="15" valign="top" height="50px">Permanent Address :&nbsp;&nbsp;<?= $profile->address2;?></td></tr>
                                <tr class="top">
                                    <td colspan="7" valign="top" height="20px">City :&nbsp;&nbsp;<?= $profile->city;?>
                                    <td colspan="8" valign="top" height="20px">State:&nbsp;&nbsp;<?= $profile->state;?></td></td>
                                 </td>
                                </tr> 
                                <tr class="top">
                                    <td colspan="5" valign="top" height="20px">Mobile No. :&nbsp;&nbsp;<?= $profile->mobile;?></td>
                                    <td colspan="10" valign="top" height="20px">Home Tel No. :&nbsp;&nbsp;<?= $profile->mobile;?></td></td>

                                </td>
                                </tr> 
                                <tr class="top"><td colspan="15" valign="top" height="20px">E-mail ID.:&nbsp;&nbsp;<?= $profile->email;?></td></tr> 
                                    <tr class="top">
                                    <td colspan="15" valign="top" height="20px">PAN :&nbsp;&nbsp;<?= $user_bank_detail[0]->pan_no;?>
                                   
                                </td>
                                </tr>
                                <tr class="top">
                                    <td colspan="5" valign="top" height="20px">Profession :&nbsp;&nbsp;
                                    <td colspan="10" valign="top" height="20px">Nature of Job/Business :&nbsp;&nbsp;</td>

                                  </td>
                                </tr> 
                                <tr class="top">
                                    <td colspan="1" valign="top" height="20px">Identity Proof:&nbsp;&nbsp;<?= $user_bank_detail[0]->adhaar_no?>
                                    <td colspan="6" valign="top" height="20px"></td>
                                    <td colspan="9" valign="top" height="20px">Address Proof:&nbsp;&nbsp;<?= $profile->address;?></td>

                                    </td>
                                </tr> 
                                <tr class="top"><td colspan="15" valign="top" height="20px">E-mail ID.:&nbsp;&nbsp;<?= $profile->email;?></td></tr>  
                                <tr class="top">
                                    <td colspan="1" valign="top" height="20px">Account No.:
                                    <td colspan="6" valign="top" height="20px"><?= $user_bank_detail[0]->account_no;?></td>
                                    <td colspan="9" valign="top" height="20px">Ifsc Code :&nbsp;&nbsp;<?= $user_bank_detail[0]->ifsc_code;?></td>

                                    </td>
                                </tr>
                                <tr class="top"><td colspan="15" valign="top" height="50px">Bank Branch Address :&nbsp;&nbsp;<?= $user_bank_detail[0]->bank_branch;?></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>NOMINEE DETAILS</center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px">Nominee Name:&nbsp;&nbsp;<?= $profile->nominee_name;?></td></tr>   
                                <tr class="top">
                                    <td colspan="15" valign="top" height="20px">Date of Birth (DD/MM/YYYY):&nbsp;<?= $profile->nominee_dob;?> 
                                   
                                    </td>
                                </tr> 
                                <!--<tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>Payment Details</center></td></tr>
                                <tr class="top">
                                    <td colspan="7" valign="top" height="20px">Package:&nbsp;&nbsp;<?= $package_detail;?>
                                    <td colspan="8" valign="top" height="20px">Amount In Rs. :</td>

                                    </td>
                                </tr> 
                                <tr class="top">
                                    <td colspan="2" valign="top" height="20px">Paytm
                                    <td colspan="2" valign="top" height="20px">Google Pay</td>

                                    <td colspan="2" valign="top" height="20px">Phonepe</td>

                                    <td colspan="9" valign="top" height="20px">Bhim UPI</td>
                                    </td>
                                </tr>
                                <tr class="top">
                                    <td colspan="5" valign="top" height="20px">Cheque / DD No. :
                                    <td colspan="2" valign="top" height="20px">Issue Date :</td>

                                    <td colspan="8" valign="top" height="20px"> Bank Name : </td>

                                    </td>
                                </tr>-->
                               <!-- <tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>Declaration</center></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="100px">I, …………………………………………………………………....................……...…….…....have read / understood / agreed to abide by and have signed the terms and conditions set-up by "Golden Birds Marketing India" (printed overleaf) for working as their Promostional Business Associate (PBA) / Independent Business Associate (IBA).</td></tr>-->
                                <tr class="top">
                                    <td colspan="2" valign="top" height="50px">
                                    <td colspan="3" valign="top" height="50px"></td>
                                    <td colspan="10" valign="top" height="50px"></td>


                                    </td>
                                </tr> 
                                <tr class="top">
                                    <td colspan="5" valign="top" class="text-center" height="50px">Payment received by (Name) : 
                                      <td colspan="10" class="text-center" valign="top" height="50px">Signatures</td>
                                    </td>
                                </tr>  
                                <tr class="top">
                                <td colspan="5" class="text-center" valign="top" height="50px">Data entered by (Name) 

                                <td colspan="10" class="text-center" valign="top" height="50px">Signatures</td>
                                 </td>
                                </tr> 
                               <!-- <tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>PRODUCT DISPATCH DETAILS</center></td></tr> 
                                <tr class="top"><td colspan="15" valign="top" height="20px"></td></tr>
                                <tr class="top"><td colspan="15" valign="top" height="20px" class="bg-dark text-white"><center>Change Life with the Changing Times</center></td></tr>       
                                <tr class="top"><td colspan="2" class="pull-left" valign="top" height="20px"></td></tr>-->

                             </tbody>
                        </table>
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

////////////////div print function /////////////////////////
//////////btn onclick  call this function ////////

function printDiv(){

var divToPrint=document.getElementById('DivIdToPrint'); ////////////  <- div id /////////////

var newWin=window.open('','Print-Window');

newWin.document.open();

newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

newWin.document.close();

setTimeout(function(){newWin.close();},10);

}
///////////////////////// end function //////////
</script>
<br>
<br>
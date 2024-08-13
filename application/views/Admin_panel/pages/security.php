     <?php
            $success['param']='success';
            $success['alert_class']='alert-success';
            $success['type']='success';
            $this->show->show_alert($success);
            ?>
            <?php 
            $erroralert['param']='error';
            $erroralert['alert_class']='alert-danger';
            $erroralert['type']='error';
            $this->show->show_alert($erroralert);
                        
    ?>
    <?php if (!$is_2fa_enabled): ?>
        <!-- Display QR Code if 2FA is not enabled -->
        <div>
            <h2>Enable 2FA</h2>
            <p>Scan this QR code with your 2FA app:</p>
            <img src="<?php echo $qr_code_url; ?>" alt="QR Code">
            <br>
        <form action="<?php echo $admin_path.'security/enable2FA'; ?>" method="post">
                <input type="hidden" id="secret" name="secret" value='<?php echo $tfa_secret; ?>'>
                <!--<button type="submit">Enable 2FA</button>-->
                <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold; margin-top: 10px; padding: 8px;">Enable 2FA</button>
        </form> 
         
        </div>
    <?php else: ?>
        <!-- Display input for OTP and Disable button if 2FA is enabled -->
        <div>
            <h2>Disable 2FA</h2>
            <form action="<?php echo $admin_path.'security/disable2FA'; ?>" method="post">
                <div class="mb-3">
                    <div class="col-6">
                        <label for="otp">Enter OTP to disable:</label>
                        <!--<input type="text" id="otp" name="otp" required>-->
                        <!--<button type="submit">Disable 2FA</button>-->
                       
                        <input style="width: 300px; type="text" class="form-control" id="otp" name="otp" placeholder="Enter 2FA Code" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold; margin-left: 15px; padding: 8px;">Disable 2FA</button>
            </form>
        </div>
    <?php endif; ?>
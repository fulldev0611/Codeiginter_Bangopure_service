<div class="content">
    <div class="container">
        <div class="row">
            <?php $this->load->view('employee/home/employee_sidemenu'); ?>
            <div class="col-xl-9 col-md-8">
            
                <h4 class="mb-4">Recent Transactions</h4>
                <div class="card transaction-table mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php if (!empty($wallet_history)) { ?>
                                <table id="order-summary" class="table table-center mb-0">
                            <?php } else { ?>
                                <table class="table table-center mb-0">
                            <?php } ?>
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Wallet</th>
                                            <th>Total</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Available</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_cr = 0;
                                        $total_dr = 0;
                                        if (!empty($wallet_history)) {
                                            foreach ($wallet_history as $key => $value) {
                                                if (!empty($value['credit_wallet'])) {
                                                    $color = 'success';
                                                    $message = 'Credit';
                                                } else {
                                                    $color = 'danger';
                                                    $message = 'Debit';
                                                }
                                                if (!empty($value["fee_amt"]) && $value["fee_amt"] > 1) {
                                                    $txt_amt = number_format($value["fee_amt"] / 100, 2);
                                                } else {
                                                    $txt_amt = 0;
                                                }

                                                if (!empty($value["total_amt"]) && $value["fee_amt"] > 1) {
                                                    $total_amt = number_format($value["total_amt"] / 100, 2);
                                                } else {
                                                    $total_amt = 0;
                                                }

                                                $total_cr += (int) $value['credit_wallet'];
                                                $total_dr += (int) abs($value['debit_wallet']);

                                                $user_currency_code = '';
                                                $userId = $this->session->userdata('id');
                                                $user_details = $this->db->where('id', $userId)->get('users')->row_array();
                                                If (!empty($userId)) {
                                                    $service_amount1 = $value["current_wallet"];
                                                    $service_amount2 = $value["credit_wallet"];
                                                    $service_amount3 = $value["debit_wallet"];
                                                    $service_amount4 = $txt_amt;
                                                    $service_amount5 = $value["avail_wallet"];
                                                    $get_currency = get_currency();
                                                    $user_currency = get_provider_currency();
                                                    $user_currency_code = $user_currency['user_currency_code'];

                                                    $service_amount1 = get_gigs_currency($value["current_wallet"], $value["currency_code"], $user_details['currency_code']);
                                                    $service_amount2 = get_gigs_currency($value["credit_wallet"], $value["currency_code"], $user_details['currency_code']);
                                                    $total_amt = get_gigs_currency($total_amt, $value["currency_code"], $user_details['currency_code']);
                                                    $service_amount3 = get_gigs_currency($value["debit_wallet"], $value["currency_code"], $user_details['currency_code']);
                                                    $service_amount4 = get_gigs_currency($txt_amt, $value["currency_code"], $user_details['currency_code']);
                                                    $service_amount5 = get_gigs_currency($value["avail_wallet"], $value["currency_code"], $user_details['currency_code']);
                                                } else {
                                                    $user_currency_code = settings('currency');
                                                    $service_amount1 = $value["current_wallet"];
                                                    $service_amount2 = $value["credit_wallet"];
                                                    $service_amount3 = $value["debit_wallet"];
                                                    $service_amount4 = $txt_amt;
                                                    $service_amount5 = $value["avail_wallet"];
                                                }
                                                echo '<tr>
                									<td>' . ($key + 1) . '</td>
                									<td>' . date("d M Y H:i:s", strtotime($value["created_at"])) . '</td>
                									<td>' . currency_conversion($user_currency_code) . '' . $service_amount1 . '</td>
                                                    <td>' .currency_conversion($user_currency_code). '' .$total_amt. '</td>
                									<td>' . currency_conversion($user_currency_code) . '' . $service_amount2 . '</td>
                									<td>' . currency_conversion($user_currency_code) . '' . $service_amount3 . '</td>
                									<td>' . currency_conversion($user_currency_code) . '' . $service_amount5 . '</td>
                									<td><lable>' . $value["reason"] . '</lable></td>
                									<td><span class="badge bg-' . $color . '-light">' . $message . '</span></td> 
                									</tr>';
                                            }
                                        } else {
                                            echo '<tr> <td colspan="8"> <div class="text-center">No data found</div></td> </tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>

                <span><p> <br></p></span>			
                <div class="row">
                    <?php
                        $user_currency_code = '';
                        $userId = $this->session->userdata('id');
                        If (!empty($userId)) {
                            $service_amount1 = $wallet['wallet_amt'];
                            $user_currency = get_provider_currency();
                            $user_currency_code = $user_currency['user_currency_code'];
                            $service_amount1 = get_gigs_currency($wallet['wallet_amt'], $wallet['currency_code'], $user_currency_code);
                        } else {
                            $user_currency_code = settings('currency');
                            $service_amount1 = $wallet['wallet_amt'];
                            
                        }
                    ?>
                    <br><br>
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Wallet</h4>

                                <div class="wallet-details">
                                    <span>Wallet Balance</span>
                                    <h3><?php echo currency_conversion($user_currency_code) . $service_amount1; ?></h3>

                                    <div class="d-flex justify-content-between my-4">
                                        <?php
                                        $total_cr = 0;
                                        $total_dr = 0;
                                        if (!empty($wallet_history)) {
                                            foreach ($wallet_history as $key => $value) {
                                                $total_cr += get_gigs_currency($value['credit_wallet'], $value['currency_code'], $user_currency_code);
                                                $total_dr += abs(get_gigs_currency($value['debit_wallet'], $value['currency_code'], $user_currency_code));
                                            }
                                        }
                                        ?>
                                        <div>
                                            <p class="mb-1">Total Credit</p>
                                            <h4><?php echo currency_conversion($user_currency_code) . number_format($total_cr, 2); ?></h4>
                                        </div>
                                        <div>
                                            <p class="mb-1">Total Debit</p>
                                            <h4><?php echo currency_conversion($user_currency_code) . number_format($total_dr, 2); ?></h4>
                                        </div>
                                    </div>
                                    <div class="wallet-progress-chart">
                                         <div class="d-flex justify-content-between">
                                            <?php
                                            if (!empty($wallet['total_credit'])) {
                                                $wallet['total_credit'] = $total_cr;
                                                $wallet['total_debit'] = $total_dr;
                                            } else {
                                                $wallet['total_credit'] = 0;
                                                $wallet['total_debit'] = $total_dr;
                                            }
                                            ?>
                                            <span><?= $wallet['currency'] . '' . abs($wallet['total_debit']); ?></span>
                                            <span><?= $wallet['currency'] . '' . number_format($wallet['total_credit'], 2); ?></span>
                                        </div>

                                        <?php
                                        $total_per = 0;
                                        if (!empty($wallet['total_debit']) && !empty($wallet['total_credit'])) {
                                            $total_per = ($wallet['total_debit'] / $wallet['total_credit']) * 100;
                                        }
                                        ?>
                                        <div class="progress mt-1">
                                            <div class="progress-bar bg-theme" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($total_per); ?>%">
                                                <?= number_format(abs($total_per), 2); ?>%
                                            </div>
                                        </div>                                     
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add To Wallet</h4>
                                <form action="<?= base_url() ?>employee/dashboard/paytab_payment" method="get" id="paytab_payment">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text display-5"><?= currency_conversion($user_currency_code); ?></label>
                                            </div>
                                             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="text"  maxlength="10" class="form-control isNumber" name="wallet_amt" id="wallet_amt" placeholder="00.00">
                                            <input type="hidden"  id="currency_val" name="currency_val"  value="<?= $user_currency_code; ?>">
                                        </div>
                                    </div>
                                </form>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3 col-xl-4">
                                            <a href="javascript:void(0);" id="pay_by_stripe"><img src="<?php echo base_url(); ?>assets/img/stripe.png"></a>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-4">
                                            <a href="javascript:void(0);" id="pay_by_paypal"><img src="<?php echo base_url(); ?>assets/img/paypal.png"></a>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="token" value="<?= $this->session->userdata('chat_token'); ?>">

    <!--- Withdraw details modal--->
    <div class="modal" id="withdraw_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="text-center"><?php echo (!empty($user_language[$user_selected]['lg_withdraw_amount'])) ? $user_language[$user_selected]['lg_withdraw_amount'] : $default_language['en']['lg_withdraw_amount']; ?></h2>
                <div class="modal-body">
                    <form id="bank_details" method="post" action="#">
                        <div class="paypal_details">
                            <div class="form-group">
                                <label><?php echo (!empty($user_language[$user_selected]['lg_paypal_id'])) ? $user_language[$user_selected]['lg_paypal_id'] : $default_language['en']['lg_paypal_id']; ?></label>
                                <input class="form-control" type="text" name="paypal_id" value="<?= (!empty($bank_account['paypal_account'])) ? $bank_account['paypal_account'] : ''; ?>" id="paypal_id">
                                <span class="paypal_id_error"></span>
                            </div>
                            <div class="form-group">
                                <label><?php echo (!empty($user_language[$user_selected]['lg_paypal_email_id'])) ? $user_language[$user_selected]['lg_paypal_email_id'] : $default_language['en']['lg_paypal_email_id']; ?></label>
                                <input class="form-control" type="text" name="paypal_email_id" value="<?= (!empty($bank_account['paypal_email_id'])) ? $bank_account['paypal_email_id'] : ''; ?>" id="paypal_email_id">
                                <span class="paypal_email_id_error"></span>
                            </div>
                        </div>
                        <div class="bank_details">
                            <div class="form-group">
                                <label>
                                   Bank Name
                                </label>
                                <input class="form-control" type="text" name="bank_name" value="<?= (!empty($bank_account['bank_name'])) ? $bank_account['bank_name'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Bank Address</label>
                                <input class="form-control" type="text" name="bank_address" value="<?= (!empty($bank_account['bank_address'])) ? $bank_account['bank_address'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Account No</label>
                                <input class="form-control" type="text" name="account_no" value="<?= (!empty($bank_account['account_number'])) ? $bank_account['account_number'] : ''; ?>" id="account_no">
                                <span class="account_no_error"></span>
                            </div>
                            <div class="form-group">
                                <label>IFSC Code</label>
                                <input class="form-control" type="text" name="ifsc_code" value="<?= (!empty($bank_account['account_ifsc'])) ? $bank_account['account_ifsc'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Sort Code</label>
                                <input class="form-control" type="text" name="sort_code" value="<?= (!empty($bank_account['sort_code'])) ? $bank_account['sort_code'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Routing No</label>
                                <input class="form-control" type="text" name="routing_number" value="<?= (!empty($bank_account['routing_number'])) ? $bank_account['routing_number'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Pan No</label>
                                <input class="form-control" type="text" name="pancard_no" value="<?= (!empty($bank_account['pancard_no'])) ? $bank_account['pancard_no'] : ''; ?>">
                            </div>
                        </div>
						<div class="razorpay_details">
                            <div class="form-group">
                                <label>
                                   Name
							   </label>
                                <input class="form-control" type="text" name="name" value="<?= (!empty($bank_account['name'])) ? $bank_account['name'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>
                                 Email ID
								 </label>
                                <input class="form-control" type="text" name="email" value="<?= (!empty($bank_account['email'])) ? $bank_account['email'] : ''; ?>">
                            </div>
							<div class="form-group">
                                <label>
                                    Contact No
                                </label>
                                <input class="form-control" type="text" name="contact" value="<?= (!empty($bank_account['contact'])) ? $bank_account['contact'] : ''; ?>">
                            </div>
							
							<div class="form-group">
                                <label>
                                  Card No
                                </label>
                                <input class="form-control" type="text" name="cardno" value="<?= (!empty($bank_account['cardno'])) ? $bank_account['cardno'] : ''; ?>">
                            </div>
							<div class="form-group">
                                <label>
                                  Card Name
                                </label>
                                <input class="form-control" type="text" name="cardname" value="<?= (!empty($bank_account['cardname'])) ? $bank_account['cardname'] : ''; ?>">
                            </div>	
							<div class="form-group">
                                <label>
                                   Bank Name
                                </label>
                                <input class="form-control" type="text" name="bank_name" value="">
                            </div>	
							<div class="form-group">
                                <label>
                                   IFSC Code
                                </label>
                                <input class="form-control" type="text" name="ifsc" value="<?= (!empty($bank_account['ifsc'])) ? $bank_account['ifsc'] : ''; ?>">
                            </div>
							<div class="form-group">
                                <label>
                                   Account No
                                </label>
                                <input class="form-control" type="text" name="accountnumber" value="<?= (!empty($bank_account['accountnumber'])) ? $bank_account['accountnumber'] : ''; ?>">
                            </div>
							<div class="form-group">
                                <label>
                                  Payment Mode
                                </label>
                                <select class="form-control" name="mode">
									<option value="">Select Payment Mode</option>
									<option value="NEFT">NEFT</option>
                                    <option value="RTGS">RTGS</option>
                                    <option value="IMPS">IMPS</option>
                                    <option value="UPI">UPI</option>
								</select>
                            </div>
							<div class="form-group">
                                <label>
                                   Payment Purpose
                                </label>
                                <select class="form-control" name="purpose">
									<option value="">Select Payment Purpose</option>
                                    <option value="refund">refund</option>
                                    <option value="cashback">cashback</option>
                                    <option value="payout" selected="">payout</option>
								</select>
                            </div>
                        </div>
                        <input type="hidden" name="amount" id="stripe_amount">
                        <input type="hidden" name="payment_type" id="payment_types">
                        <!--<input type="hidden" id="wallet_amount" value="<?php echo (int)$total_amount; ?>">-->
                        <button type="submit" class="btn btn-primary btn-block withdraw-btn1">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/employee_wallet.js?v1.01"></script>
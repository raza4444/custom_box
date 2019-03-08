 @foreach($Topic->webmasterSection->customFields as $customField)
                  <?php
                  if ($customField->$cf_title_var != "") {
                    $cf_title = $customField->$cf_title_var;
                } else {
                    $cf_title = $customField->$cf_title_var2;
                }

                $cf_saved_val = "";
                $cf_saved_val_array = array();
                if (count($Topic->fields) > 0) {
                    foreach ($Topic->fields as $t_field) {
                        if ($t_field->field_id == $customField->id) {
                            if ($customField->type == 7) {
                                                            // if multi check
                                $cf_saved_val_array = explode(", ", $t_field->field_value);
                            } else {
                                $cf_saved_val = $t_field->field_value;
                            }
                        }
                    }
                }

                ?>

@if($customField->type ==7)
    {{--Multi Check--}}
    <div class="row field-row">
        
        <div class="col-lg-12">
            <?php
            $cf_details_var = "details_" . trans('backLang.boxCode');
            $cf_details_var2 = "details_en" . trans('backLang.boxCodeOther');
            if ($customField->$cf_details_var != "") {
                $cf_details = $customField->$cf_details_var;
            } else {
                $cf_details = $customField->$cf_details_var2;
            }
            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
            $line_num = 1;

            ?>



            @foreach ($cf_details_lines as $cf_details_line)
            @if (in_array($line_num,$cf_saved_val_array))
            @if($cf_details_line == 'Paypal')
            <br><br>
            <input type="radio" checked name="payment_method" value="paypal" ><span> Payment By Paypal</span>
            @elseif($cf_details_line == 'Stripe')
            <br><br>


            <input type="radio" name="payment_method" value="stripe" > <span> Payment By Cradit Card(Stripe)</span>

             <div id="stripes" class="hi" style="display: none;">

                             <!--  <h4 class="border-bottom pb-4"><i class="ti ti-wallet mr-3 text-primary"></i>Card Details</h4> -->
                             <div class="row mb-5">
                                <div class="form-group col-sm-6">
                                    <label>Card Number:</label>
                                    <input type="text" onchange="check_cardNumber()" onkeyup="check_cardNumber()" class="form-control" autocomplete="off" id="cardNumber" required="" placeholder="Enter card number" value="">
                                    <p></p>
                                    <div class="error error_cardNumber"></div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>CVC/CVV:</label>
                                    <input type="text" onchange="check_cvcNumber()" onkeyup="check_cvcNumber()" class="form-control" autocomplete="off" id="cardCVC" required="" placeholder="Enter cvc/cvv number" value="">
                                    <p></p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Expiration Month:</label>
                                    <select class="form-control" id="cardExpMonth" required="">

                                        <option value="01">01 (Jan)</option>
                                        <option value="02">02 (Feb)</option>
                                        <option value="03">03 (Mar)</option>
                                        <option value="04">04 (Apr)</option>
                                        <option value="05">05 (May)</option>
                                        <option value="06">06 (Jun)</option>
                                        <option value="07">07 (Jul)</option>
                                        <option value="08">08 (Aug)</option>
                                        <option value="09">09 (Sep)</option>
                                        <option value="10">10 (Oct)</option>
                                        <option value="11">11 (Nov)</option>
                                        <option value="12" selected>12 (Dec)</option>


                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Expiration Year:</label>
                                    <select class="form-control" id="cardExpYear" required="">
                                        <?php 

                                        $c_year = date('Y');
                                        for ($i = $c_year; $i < $c_year + 12 ; $i++) { 

                                            if($i == $c_year){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }
                                            else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }

                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>



            @endif

            @endif
            <?php
            $line_num++;
            ?>
            @endforeach
        </div>
    </div>
    @endif
 @endforeach
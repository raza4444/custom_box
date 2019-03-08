
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
                                            @if($customField->type ==6)

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
                                                                @if ($line_num == $cf_saved_val)
                                                                    {{ $cf_details_line }}
                                                <input type="hidden" name="price_currency" value="{{ $cf_details_line }}" >
                                                                @endif
                                                                <?php
                                                                $line_num++;
                                                                ?>
                                                            @endforeach


                                            @endif



                                            @endforeach
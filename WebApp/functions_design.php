<?php

#########################
###  Design function  ###
#########################
class design
{
    //Create date input element
    public static function input_date ($TrDateDefault)
        {
            echo "<div class='form-group'>";
                echo "<label for='Date'>Date</label>";
                echo "<input id = 'Date' type='date' name='Date' class='form-control'   value = '${TrDateDefault}'/>";
                echo "<span class='help-block'></span>";
            echo "</div>\n";

        }


    //Create status input element
    public static function input_status ($TrStatusDefault)
        {
            $StatusArrayDesc = array ("None", "Reconciled", "Void", "Follow Up", "Duplicate");
            $StatusArrayDB = array ("", "R", "V", "F", "D");

            echo "<div class='form-group'>";
                echo "<label for='Status'>Status</label>";
                echo "<select id ='Status' name='Status' class='form-control'>";
                for ($i = 0; $i < sizeof($StatusArrayDesc); $i++)
                {
                    if ($StatusArrayDB[$i] == $TrStatusDefault)
                        {echo "<option value = '${StatusArrayDB[$i]}' selected> ${StatusArrayDesc[$i]} </option>";}
                    else
                        {echo "<option value = '${StatusArrayDB[$i]}'> ${StatusArrayDesc[$i]} </option>";}
                }
                echo "</select>";
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }


    //Create type input element
    public static function input_type ($TrTypeDefault)
    {
        $TypeArrayDesc = array ('Withdrawal', 'Deposit', 'Transfer');

        echo '<div class="form-group">';
            echo '<label for="Type">Type</label>';
#            echo '<select id="Type" name="Type" class="form-control" onchange="enable_element(\'ToAccount\',\'Type\',\'Transfer\'); disable_element(\'Payee\',\'Type\',\'Transfer\')">';
            $on_change = 'onchange="enable_element(\'ToAccount\',\'Type\',\'Transfer\'); disable_element(\'Payee\',\'Type\',\'Transfer\')"';
            for ($i = 0; $i < sizeof($TypeArrayDesc); $i++)
            {
                $is_selected = '';
                if ($TypeArrayDesc[$i] == $TrTypeDefault)
                {
#                    $is_selected = 'selected';
                    $is_selected = 'checked';
                }
                $element_id = 'Type_' . $TypeArrayDesc[$i];
                $element_onchange = str_replace('Type', $element_id, $on_change);
#                echo "<option value='${TypeArrayDesc[$i]}' $is_selected> ${TypeArrayDesc[$i]} </option>";
                echo '<input type="radio" id="' . $element_id . '" name="Type" value="' . $TypeArrayDesc[$i] . '" ' . $element_onchange . $is_selected . '>';
                echo '<label for="' . $element_id . '">' . $TypeArrayDesc[$i] . '</label>';

            }
            echo '</select>';
            echo '<span class="help-block"></span>';
        echo '</div>'."\n";
    }


    //Create account input element
    public static function input_account ($TrAccountDefault)
        {
            $AccountArrayDesc = db_function::bankaccount_select_all();
            if (sizeof($AccountArrayDesc) == 0)
                {$AccountArrayDesc[0] = "None";}

            echo "<div class='form-group'>";
                echo "<label for='Account'>Account</label>";
                echo "<select id ='Account' name='Account' class='form-control'>";
                for ($i = 0; $i < sizeof($AccountArrayDesc); $i++)
                {
                    if ($AccountArrayDesc[$i] == $TrAccountDefault)
                        {echo "<option value=\"${AccountArrayDesc[$i]}\" selected> ${AccountArrayDesc[$i]} </option>";}
                    else
                        {echo "<option value=\"${AccountArrayDesc[$i]}\"> ${AccountArrayDesc[$i]} </option>";}
                }
                echo "</select>";
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }


    //Create toaccount input element
    public static function input_toaccount ($TrToAccountDefault)
        {
            $ToAccountArrayDesc = db_function::bankaccount_select_all();
            array_unshift($ToAccountArrayDesc,"None");

            echo "<div class='form-group'>";
                echo "<label for='ToAccount'>To Account</label>";
                echo "<select id ='ToAccount' name='ToAccount' class='form-control'>";
                for ($i = 0; $i < sizeof($ToAccountArrayDesc); $i++)
                {
                    if ($ToAccountArrayDesc[$i] == $TrToAccountDefault)
                        {echo "<option value=\"${ToAccountArrayDesc[$i]}\" selected> ${ToAccountArrayDesc[$i]} </option>";}
                    else
                        {echo "<option value=\"${ToAccountArrayDesc[$i]}\"> ${ToAccountArrayDesc[$i]} </option>";}
                }
                echo "</select>";
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }


    //Create payee input element
    public static function input_payee ($TrPayeeDefault)
        {
            $PayeeArrayDesc = db_function::payee_select_all_name();
            array_unshift($PayeeArrayDesc,"None");

            echo "<div class='form-group'>";
                echo "<label for='Payee'>Payee</label>";
                echo "<input id='Payee' type='text' name='Payee' class='form-control' placeholder='Choose a payee' autocomplete = 'off' required />";
                echo "<span class='help-block'></span>";
            echo "</div>\n";

            echo "<script type='text/javascript'>";
                echo "var PayeeList = " . json_encode($PayeeArrayDesc) . ";";
                echo "$('#Payee').typeahead({hint: true, highlight: true, minLength: 0},{name: 'PayeeList', limit:15, displayKey: 'value', source: substringMatcher(PayeeList)});";
                if ($TrPayeeDefault != "")
                    {echo "document.getElementById('Payee').value='${TrPayeeDefault}'";}
            echo "</script>";
        }


    //Create category input element
    public static function input_category ($TrCategoryDefault)
        {
            $CategoryArrayDesc = db_function::category_select_distinct();
            array_unshift($CategoryArrayDesc,"None");

            echo "<div class='form-group'>";
                echo "<label for='Category'>Category</label>";
                echo "<input id='Category' type='text' name='Category' class='form-control' placeholder='Choose a category' autocomplete = 'off' required />";
                echo "<span class='help-block'></span>";
            echo "</div>\n";

            echo "<script type='text/javascript'>";
                echo "var CategoryList = " . json_encode($CategoryArrayDesc) . ";";
                echo "$('#Category').typeahead({hint: true, highlight: true, minLength: 0},{name: 'CategoryList', limit:15, displayKey: 'value', source: substringMatcher(CategoryList)});";
                if ($TrCategoryDefault != "")
                    {echo "document.getElementById('Category').value='${TrCategoryDefault}';";}
            echo "</script>";
        }


    //Create subcategory input element
    public static function input_subcategory ($TrSubCategoryDefault)
        {
            echo "<div class='form-group'>";
                echo "<label for='SubCategory'>SubCategory</label>";
                echo "<input id='SubCategory' type='text' name='SubCategory' class='form-control' placeholder='Choose a subcategory' autocomplete='off' />";
                echo "<span class='help-block'></span>";
            echo "</div>\n";

            echo "<script type='text/javascript'>";
                if ($TrSubCategoryDefault != "")
                    {echo "document.getElementById('SubCategory').value='${TrSubCategoryDefault}';";}
            echo "</script>";
        }


    //Create amount input element
    public static function input_amount ($TrAmountDefault)
        {
            echo "<div class='form-group'>";
                echo "<label for='Amount'>Amount</label>";
                if ($TrAmountDefault <> 0)
                    {
                        echo "<input id='Amount' type='number' name='Amount' class='form-control' placeholder='New transaction amount' min='0.01' step ='0.01' value='${TrAmountDefault}' required />";
                    }
                else
                    {
                        echo "<input id='Amount' type='number' name='Amount' class='form-control' placeholder='New transaction amount' min='0.01' step ='0.01' required />";
                    }
                echo "<span class='help-block'></span>";
            echo "</div>\n";

        }


    //Create notes input element
    public static function input_notes ($TrNotesDefault)
        {
            echo "<div class='form-group'>";
                echo "<label for='Notes'>Notes</label>";
                if ($TrNotesDefault <> "Empty")
                    {
                        echo "<textarea id='Notes' name='Notes' class='form-control' rows='5' placeholder='New transaction notes'>${TrNotesDefault}</textarea>";
                    }
                else
                    {
                        echo "<textarea id='Notes' name='Notes' class='form-control' rows='5' placeholder='New transaction notes'></textarea>";
                    }
                echo "<span class='help-block'></span>";
            echo "</div>\n";

        }


    //Create Hidden Field
    public static function input_hidden ($FieldName,$Value)
    {
        echo '<input type="hidden" id="' . $FieldName . '" name="' . $FieldName . '" value="' . $Value . '" />';
    }


    //Create setting input element
    public static function settings ($VarName,$VarValue,$PlaceHolder,$InputType,$Required)
        {
            echo "<div class='form-group'>";
                echo "<label for='Set_${VarName}'>".str_replace("_"," ",$VarName)."</label>";
                if ($VarValue == "")
                    {
                        if ($Required == True)
                            {
                                echo "<input id='Set_${VarName}' type='${InputType}' name='Set_${VarName}' class='form-control' placeholder='${PlaceHolder}' autocomplete = 'off' required />";
                            }
                        elseif ($Required == False)
                            {
                                echo "<input id='Set_${VarName}' type='${InputType}' name='Set_${VarName}' class='form-control' placeholder='${PlaceHolder}' autocomplete = 'off' />";
                            }
                    }
                else
                    {
                        if ($Required == True)
                            {
                                echo "<input id='Set_${VarName}' type='${InputType}' name='Set_${VarName}' class='form-control' value='${VarValue}' autocomplete = 'off' required />";
                            }
                        elseif ($Required == False)
                            {
                                echo "<input id='Set_${VarName}' type='${InputType}' name='Set_${VarName}' class='form-control' value='${VarValue}' autocomplete = 'off' />";
                            }
                    }
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }

    //Create seting checkbox element
    public static function settings_checkbox ($VarName,$VarValue,$VarDescription)
        {
            echo "<div class='checkbox'>";
                echo "<label>";
                    if ($VarValue == True)
                        {echo "<input id='${VarName}' type='checkbox' name='${VarName}' value='True' checked>${VarDescription}";}
                    else
                        {echo "<input id='${VarName}' type='checkbox' name='${VarName}' value='True'>${VarDescription}";}
                echo "</label>";
            echo "</div>\n";
        }


    //Create password input element
    public static function settings_password ($VarName,$PlaceHolder,$Required)
        {
            echo "<div class='form-group'>";
                echo "<label for='Set_${VarName}'>".str_replace("_"," ",$VarName)."</label>";
                    if ($Required == True)
                        {
                            echo "<input id='Set_${VarName}' type='Password' name='Set_${VarName}' class='form-control' placeholder='${PlaceHolder}' required />";
                        }
                    elseif ($Required == False)
                        {echo "<input id='Set_${VarName}' type='Password' name='Set_${VarName}' class='form-control' placeholder='${PlaceHolder}' />";}
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }


    //Design setting default account
    public static function settings_default_account ($TrAccountDefault)
        {
            $AccountArrayDesc = db_function::bankaccount_select_all();
            if (sizeof($AccountArrayDesc) == 0)
                {$AccountArrayDesc[0] = "None";}

            echo "<div class='form-group'>";
                echo "<label for='Default_Account'> Default Account</label>";
                echo "<select id ='Default_Account' name='Default_Account' class='form-control'>";
                for ($i = 0; $i < sizeof($AccountArrayDesc); $i++)
                {
                    if ($AccountArrayDesc[$i] == $TrAccountDefault)
                        {echo "<option selected> ${AccountArrayDesc[$i]} </option>";}
                    else
                        {echo "<option> ${AccountArrayDesc[$i]} </option>";}
                }
                echo "</select>";
                echo "<span class='help-block'></span>";
            echo "</div>\n";
        }


    //Design section legend
    public static function section_legened ($Text)
        {
                echo "<h4>${Text}</h4>";
                echo "<hr>";
        }


    //Design table cell
    public static function table_cell ($value,$css_class,$s_extra='')
        {
            echo '<td class="' . $css_class .'" ' . $s_extra . '>';
            echo $value;
            echo '</td>';
        }
}

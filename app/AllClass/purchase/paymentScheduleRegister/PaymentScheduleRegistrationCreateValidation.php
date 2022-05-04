<?php


namespace App\AllClass\purchase\paymentScheduleRegister;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\AlphanumericKatakanaSymbolValidation;


class PaymentScheduleRegistrationCreateValidation{
    public static function handle($request){

//        dd($request);
        //if any payment method set to 03 method then required validation triggered
        $flag_231=null;
        if ($request['purchase_payment_schedule_reg_211']=='D903'){
            $flag_231=1;
        }
        elseif ($request['purchase_payment_schedule_reg_213']=='D903'){
            $flag_231=1;
        }
        elseif ($request['purchase_payment_schedule_reg_215']=='D903'){
            $flag_231=1;
        }
        elseif ($request['purchase_payment_schedule_reg_221']=='D903'){
            $flag_231=1;
        }
        elseif ($request['purchase_payment_schedule_reg_223']=='D903'){
            $flag_231=1;
        }
        elseif ($request['purchase_payment_schedule_reg_225']=='D903'){
            $flag_231=1;
        }
        else{
            $flag_231=null;
        }

        $messageFlag = 0;
        $rules = [];
        // 101
        $rules['purchase_payment_schedule_reg_101'] = ['required', 'date_format:Y/m/d', new AlphanumericKatakanaSymbolValidation];


        // 102
        $rules['purchase_payment_schedule_reg_102'] = ['required'];


        // 3.1 error validation
        if($request['success_result_3_1']){
            if($request['success_result_3_1'] == 'success_result_3_1'){
                // Checking the condition
                if($request["purchase_payment_schedule_reg_211"] == '' && $request["purchase_payment_schedule_reg_213"] == '' && $request["purchase_payment_schedule_reg_215"] == '' && $request["purchase_payment_schedule_reg_221"] == '' && $request["purchase_payment_schedule_reg_223"] == '' && $request["purchase_payment_schedule_reg_225"] == ''){
                    $rules["custom_3_1_message"] = ['required'];
                }else{
                    $messageFlag = 1;
                }

                // checking the 0 field of nearest field
                if($request["purchase_payment_schedule_reg_211"] != '' && $request["purchase_payment_schedule_reg_212"] == 0){
                    $rules['purchase_payment_schedule_reg_212'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_213"] != '' && $request["purchase_payment_schedule_reg_214"] == 0){
                    $rules['purchase_payment_schedule_reg_214'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_215"] != '' && $request["purchase_payment_schedule_reg_216"] == 0){
                    $rules['purchase_payment_schedule_reg_216'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_221"] != '' && $request["purchase_payment_schedule_reg_222"] == 0){
                    $rules['purchase_payment_schedule_reg_222'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_223"] != '' && $request["purchase_payment_schedule_reg_224"] == 0){
                    $rules['purchase_payment_schedule_reg_224'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_225"] != '' && $request["purchase_payment_schedule_reg_226"] == 0){
                    $rules['purchase_payment_schedule_reg_226'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }
            }
        }


        // 3.2 error validation
        if($request['success_result_3_2']){
            if($request['success_result_3_2'] == 'success_result_3_2'){
                if($request["purchase_payment_schedule_reg_211"] == '' && $request["purchase_payment_schedule_reg_213"] == '' && $request["purchase_payment_schedule_reg_215"] == '' && $request["purchase_payment_schedule_reg_221"] == '' && $request["purchase_payment_schedule_reg_223"] == '' && $request["purchase_payment_schedule_reg_225"] == ''){
                    $rules["custom_3_2_message"] = ['required'];
                }else{
                    $messageFlag = 1;
                }

                // checking the 0 field of nearest field
                if($request["purchase_payment_schedule_reg_211"] != '' && $request["purchase_payment_schedule_reg_212"] == 0){
                    $rules['purchase_payment_schedule_reg_212'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_213"] != '' && $request["purchase_payment_schedule_reg_214"] == 0){
                    $rules['purchase_payment_schedule_reg_214'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_215"] != '' && $request["purchase_payment_schedule_reg_216"] == 0){
                    $rules['purchase_payment_schedule_reg_216'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_221"] != '' && $request["purchase_payment_schedule_reg_222"] == 0){
                    $rules['purchase_payment_schedule_reg_222'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_223"] != '' && $request["purchase_payment_schedule_reg_224"] == 0){
                    $rules['purchase_payment_schedule_reg_224'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }

                if($request["purchase_payment_schedule_reg_225"] != '' && $request["purchase_payment_schedule_reg_226"] == 0){
                    $rules['purchase_payment_schedule_reg_226'] = ['required', 'not_in:0', new AlphanumericKatakanaSymbolValidation];
                }
            }
        }

        // 231
        if ($flag_231==1){
            $rules['purchase_payment_schedule_reg_231'] = ['required', 'date_format:Y/m/d', new AlphanumericKatakanaSymbolValidation];
        }


        $message = [];
        $message['required'] = '【:attribute】必須項目に入力がありません。';


        if($messageFlag == 0){
            $message['custom_3_1_message.required'] = '該当するデータがありません。';
            $message['custom_3_2_message.required'] = '該当するデータがありません。';
        }else{
            $message['custom_3_1_message.required'] = '支払額0円は登録できません。';
            $message['custom_3_2_message.required'] = '支払額0円は登録できません。';
        }

      //  $message['custom_3_2_message.required'] = '支払額0円は登録できません。';
        $message['purchase_payment_schedule_reg_212.not_in'] = 'purchase_payment_schedule_reg_212_not_in_0';
        $message['purchase_payment_schedule_reg_214.not_in'] = 'purchase_payment_schedule_reg_214_not_in_0';
        $message['purchase_payment_schedule_reg_216.not_in'] = 'purchase_payment_schedule_reg_216_not_in_0';
        $message['purchase_payment_schedule_reg_222.not_in'] = 'purchase_payment_schedule_reg_222_not_in_0';
        $message['purchase_payment_schedule_reg_224.not_in'] = 'purchase_payment_schedule_reg_224_not_in_0';
        $message['purchase_payment_schedule_reg_226.not_in'] = 'purchase_payment_schedule_reg_226_not_in_0';
        $message['numeric'] = '【:attribute】半角数字以外は使用できません。';
        $message['digits_between'] = '【:attribute】:max桁以下で入力してください。';
        $message['max'] = '【:attribute】:max桁以下で入力してください。';
        $message['mimes'] = '【:attribute】pdf zip のみOK。';
        $message['lte'] = '【:attribute】日付の入力が適切ではありません。';
        $message['gte'] = '【:attribute】日付の入力が適切ではありません。';

        $attributes = [
            'purchase_payment_schedule_reg_101' => '締切日',
            'purchase_payment_schedule_reg_102' => '仕入先・購入先',
            'purchase_payment_schedule_reg_212' => '仕入支払額1',
            'purchase_payment_schedule_reg_214' => '仕入支払額2',
            'purchase_payment_schedule_reg_216' => '仕入支払額3',
            'purchase_payment_schedule_reg_222' => '購入支払額1',
            'purchase_payment_schedule_reg_224' => '購入支払額2',
            'purchase_payment_schedule_reg_226' => '購入支払額3',
            'purchase_payment_schedule_reg_231' => '手形期日'
        ];

        return Validator::make($request, $rules, $message, $attributes);
    }
}

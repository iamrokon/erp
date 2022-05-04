<?php

namespace App\AllClass\sales\unearnedSalesCancellation;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\AlphanumericKatakanaSymbolValidation;


class UnearnedSalesCancellationValidation{
    public static function handle($request){
        $rules = [];
        
        $rules['unearned_sales_cancellation_101'] = ['required', 'max:10'];
        $rules['unearned_sales_cancellation_102'] = ['required'];
           


        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';

        $attributes = [
            'unearned_sales_cancellation_101' => '売上番号',
            'unearned_sales_cancellation_102' => '取消日'
        ];

        return Validator::make($request, $rules, $messages, $attributes);
    }
}

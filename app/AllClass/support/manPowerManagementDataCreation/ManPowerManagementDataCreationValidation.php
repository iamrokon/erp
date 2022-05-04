<?php

namespace App\AllClass\support\manPowerManagementDataCreation;


use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\AllClass\AlphanumericKatakanaSymbolValidation;


class ManPowerManagementDataCreationValidation{
    public static function handle($request){
        $newRequest = $request;
        if($request["man_power_management_data_creation_101"] == 1){
            $reqToChange = ['man_power_management_data_creation_103_1', 
                        'man_power_management_data_creation_103_2', 'man_power_management_data_creation_104_1', 'man_power_management_data_creation_104_2'];
        }else{
            if($request["man_power_management_data_creation_101"] == 2){
                $reqToChange = ['man_power_management_data_creation_105_1', 
                        'man_power_management_data_creation_105_2'];
            }
        }

        
        foreach ($newRequest as $key => $value) {
            if (in_array($key, $reqToChange)) {
                $newRequest[$key] = str_replace('/', '', $value);
            }
        }

        $rules = [];

        if($request["man_power_management_data_creation_101"] == 1){
            $rules['man_power_management_data_creation_103_1'] = ['required', 'max:8', new DateCheckGreaterThan($newRequest['man_power_management_data_creation_103_2'], '入力日付1')];
            $rules['man_power_management_data_creation_103_2'] =  ['required', 'max:8', new DateCheckLessThan($newRequest['man_power_management_data_creation_103_1'], '入力日付2')];
            $rules['man_power_management_data_creation_104_1'] = ['required', new DateCheckGreaterThan($newRequest['man_power_management_data_creation_104_2'], '受注番号1')];
            $rules['man_power_management_data_creation_104_2'] =  ['required', new DateCheckLessThan($newRequest['man_power_management_data_creation_104_1'], '受注番号2')];
        }else{
            if($request["man_power_management_data_creation_101"] == 2){
                $rules['man_power_management_data_creation_105_1'] = ['required', 'max:8', new DateCheckGreaterThan($newRequest['man_power_management_data_creation_105_2'], '伝票日付1')];
                $rules['man_power_management_data_creation_105_2'] =  ['required', 'max:8', new DateCheckLessThan($newRequest['man_power_management_data_creation_105_1'], '伝票日付2')];

            }
        }


        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['max'] = '【:attribute】:max桁以下で入力してください。';

        $attributes = [
            'man_power_management_data_creation_103_1' => '入力日付1',
            'man_power_management_data_creation_103_2' => '入力日付2',
            'man_power_management_data_creation_104_1' => '受注番号1',
            'man_power_management_data_creation_104_2' => '受注番号2',
            'man_power_management_data_creation_105_1' => '伝票日付1',
            'man_power_management_data_creation_105_2' => '伝票日付2'
        ];
        return Validator::make($newRequest, $rules, $messages, $attributes);
    }
}

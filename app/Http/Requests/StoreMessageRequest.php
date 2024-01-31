<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sendMessage' => ['string','max:30']
        ];
    }
    
    public function messages()
    {
        if(Auth::user()->is_japanese==1){
            return [
                'sendMessage.max' => 'メッセージは30文字以内で入力してください。'
            ];
        }else{
            return [
                'sendMessage.max' => 'Your message should be no longer than 30 characters.'
            ];
        }
    }
    
}

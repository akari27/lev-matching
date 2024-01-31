<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:50'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'age' => ['integer', 'min:18', 'max:150'],
            'comment'  => ['nullable','string','max:20'],
            'reason' => ['nullable','string','max:20']
        ];
    }
    
    public function messages(){
        if(Auth::user()->is_japanese==1){
            return 
            [
                'name.max' => '名前は50文字以内で入力してください。',
                'age.min' => '18歳未満の方はご利用いただけません。',
                'comment.max' => 'ヒトコトは20文字以内で入力してください。',
            ];
        }else{
            return 
            [
                'name.max' => 'Name must be 50 characters or less.',
                'age.min' => 'This service is not available to persons under 18 years of age.',
                'comment.max' => 'Please enter your comment in 20 characters or less.',
                'reason.max' => 'Please enter the reason for your visit in 20 characters or less.',
            ];
        }
    }
}

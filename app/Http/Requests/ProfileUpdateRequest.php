<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'gender_flag' => ['integer', 'max:1'],
            'age' => ['integer', 'max:100'],
            'is_japanese' => ['integer', 'max:1'],
            'comment' => ['string','max:255'],
            'hobby_category_id' => ['integer','max:100'],
            'register_location_id' => ['integer','max:100'],
            'often_go_location_id' => ['integer','max:100'],
        ];
    }
}

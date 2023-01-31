<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\PhoneNumberValidation;
use Illuminate\Support\Facades\Auth;

class UpdateAccountRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'phone_number' => [new PhoneNumberValidation, Rule::unique('users')->ignore(Auth::id())],
            'company_name' => ['required', 'string', 'max:255'],
            'division_name' => ['required', 'string', 'max:255'],
            'profile_picture' => ['required', 'image'],
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();
        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phoneNumberObject = $phoneNumberUtil->parse($this['phone_number'], 'ID');
        $data['phone_number'] = $phoneNumberUtil->format($phoneNumberObject, \libphonenumber\PhoneNumberFormat::E164);
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}

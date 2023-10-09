<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrokerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'broker_name' => 'required|unique:brokers,broker_name,'.$this->id,
            'broker_email' => 'required|email|unique:brokers,broker_email,'.$this->id,
            'broker_phone_number' => 'required|digits:10|unique:brokers,broker_phone_number,'.$this->id,
        ];
    }

    public function requestedField(){
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'broker_name' => $this->broker_name,
            'broker_email' => $this->broker_email,
            'broker_phone_number' => $this->broker_phone_number,
        ];
    }
}

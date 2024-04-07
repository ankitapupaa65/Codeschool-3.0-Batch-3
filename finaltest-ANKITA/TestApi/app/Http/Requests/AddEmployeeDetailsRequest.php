<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddEmployeeDetailsRequest extends FormRequest
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
            'employee_details.first_name' => 'required|string',
            'employee_details.last_name' => 'required|string',
            'employee_details.email' => 'required|email',
            'employee_details.phone_no' => 'required',
            'employee_details.designation_id' => 'required|integer',
            'address_details.current_address.country_id' => 'required|integer',
            'address_details.current_address.district_id' => 'required|integer',
            'address_details.current_address.state_id' => 'required|integer',
            'address_details.current_address.house_name' => 'required',
            'address_details.current_address.land_mark' => 'required',

            'address_details.permanent_address.country_id' => 'required|integer',
            'address_details.permanent_address.district_id' => 'required|integer',
            'address_details.permanent_address.house_name' => 'required|string',
            'address_details.permanent_address.land_mark' => 'required|string',
            'address_details.permanent_address.state_id' => 'required|integer',
            'salary_details.earning.basic_pay' => 'required',
            'salary_details.earning.cca' => 'required',
            'salary_details.earning.hra' => 'required',
            'salary_details.deduction.it' => 'required',
            'salary_details.deduction.pt' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'employee_details.first_name.required' => 'The first name field is required.',
            'employee_details.first_name.string' => 'The first name must be a string.',
            'employee_details.last_name.required' => 'The last name field is required.',
            'employee_details.last_name.string' => 'The last name must be a string.',
            'employee_details.email.required' => 'The email field is required.',
            'employee_details.email.email' => 'Please enter a valid email address.',
            'employee_details.phone_no.required' => 'The phone number field is required.',
            'employee_details.designation_id.required' => 'The designation id  field is required.',
            'employee_details.designation_id.integer' => 'The designation ID  must be an integer.',
            'address_details.current_address.country_id.required' => 'The Country ID field for current address is required.',
            'address_details.current_address.country_id.integer' => 'The Country ID for current address must be an integer.',
            'address_details.current_address.district_id.required' => 'The District ID field for current address is required.',
            'address_details.current_address.district_id.integer' => 'The District ID for current address must be an integer.',
            'address_details.current_address.state_id.required' => 'The State ID field for current address is required.',
            'address_details.current_address.state_id.integer' => 'The State ID for current address must be an integer.',
            'address_details.current_address.house_name.required' => 'The House name  field for current address is required.',
            'address_details.current_address.land_mark.required' => 'The Land mark field for current address is required.',
            'address_details.permanent_address.country_id.required' => 'The Country ID field for permanent address is required.',
            'address_details.permanent_address.country_id.integer' => 'The Country ID for permanent address must be an integer.',
            'address_details.permanent_address.district_id.required' => 'The District ID field for permanent address is required.',
            'address_details.permanent_address.district_id.integer' => 'The District ID for permanent address must be an integer.',
            'address_details.permanent_address.state_id.required' => 'The State ID field for permanent address is required.',
            'address_details.permanent_address.state_id.integer' => 'The State ID for permanent address must be an integer.',
            'address_details.permanent_address.house_name.required' => 'The House name  field for permanent address is required.',
            'address_details.permanent_address.land_mark.required' => 'The Land mark field for permanent address is required.',

            'salary_details.earning.basic_pay.required' => 'The Basic pay field  for earning  is required.',
            'salary_details.earning.cca.required' => 'The  CCA field   for earning  is required.',
            'salary_details.earning.hra.required' => 'The HRA field   for earning is required.',
            'salary_details.deduction.it.required' => 'The IT field   for deduction  is required.',
            'salary_details.deduction.pt.required' => 'The  PT field  for deduction  is required.',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'false',
            'message' => $validator->errors()->first(),
        ]));
    }
}

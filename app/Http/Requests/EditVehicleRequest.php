<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditVehicleRequest extends FormRequest
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
            'name' => 'max:255|string|unique:vehicles,name'. $this->id,
            'image' => 'image|mimes:jpeg,png,jpg',
            'max_passengers' => 'integer',
            'min_price' => 'numeric',
            'kilometer_price' => 'numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'Vehicle name cannot be more than 255 characters',
            'name.unique' => 'Vehicle name is already exist',
            'name.string' => 'Vehicle name must characters',

            'image.mimes' => 'allow types : jpeg,png,jpg ',

            'max_passengers.integer' => 'Max number of passengers must be integer',

            'min_price.numeric' => 'Minimum price must be numeric',

            'kilometer_price.numeric' => 'Kilometer price must be numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AddVehicleRequest extends FormRequest
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
            'name' => 'required|max:255|string|unique:vehicles,name',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'max_passengers' => 'required|integer',
            'min_price' => 'required|numeric',
            'kilometer_price' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vehicle name is required',
            'name.max' => 'Vehicle name cannot be more than 255 characters',
            'name.unique' => 'Vehicle name is already exist',
            'name.string' => 'Vehicle name must characters',

            'image.required' => 'Vehicle Image is required',
            'image.mimes' => 'allow types : jpeg,png,jpg ',

            'max_passengers.required' => 'Max number of passengers is required',
            'max_passengers.integer' => 'Max number of passengers must be integer',

            'min_price.required' => 'Minimum price is required',
            'min_price.numeric' => 'Minimum price must be numeric',

            'kilometer_price.required' => 'Kilometer price is required',
            'kilometer_price.numeric' => 'Kilometer price must be numeric',
        ];
    }
}

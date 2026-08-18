<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LineRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "code" => $this->is('api/admin/lines/*') ? "exclude" : "required|between:2,4|uppercase|unique:lines,line_code" ,
            "name" => "required|max:255",
            "station_a_code" => "required|exists:stations,station_code",
            "station_b_code" => "required|exists:stations,station_code",
            "seat_capacity" => "required|integer|between:1,500",
            "crossing_minutes" => "required|integer|between:1,120",
            "fare_cny" => "required|numeric|between:0,999.99",
            "status" => "nullable|in:active,suspended",
        ];
    }
}

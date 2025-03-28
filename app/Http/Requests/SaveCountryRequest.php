<?php

namespace App\Http\Requests;

use App\Dto\SaveCountryDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string|null $code
 */
class SaveCountryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:countries,name,' . $this->route('country'),
            'code' => 'nullable|string|min:3|max:3|unique:countries,code,' . $this->route('country')
        ];
    }

    public function getDto(): SaveCountryDto
    {
        return (new SaveCountryDto())->setName($this->name)->setCode($this->code);
    }
}

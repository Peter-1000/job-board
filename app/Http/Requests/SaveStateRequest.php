<?php

namespace App\Http\Requests;

use App\Dto\SaveStateDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string|null $code
 * @property int $country_id
 */
class SaveStateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:states,name,' . $this->route('state'),
            'code' => 'nullable|string|max:10|unique:states,code',
            'country_id' => 'required|exists:countries,id'
        ];
    }


    public function getDto(): SaveStateDto
    {
        return (new SaveStateDto())->setName($this->name)->setCode($this->code)->setCountryId($this->country_id);
    }
}

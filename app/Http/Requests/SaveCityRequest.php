<?php

namespace App\Http\Requests;

use App\Dto\SaveCityDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property int $state_id
 */
class SaveCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255|unique:cities,name,' . $this->route('city'),
            'state_id' => 'required|integer|exists:states,id',
        ];
    }

    public function getDto(): SaveCityDto
    {
        return (new SaveCityDto())->setName($this->name)->setStateId($this->state_id);
    }
}

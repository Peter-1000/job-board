<?php

namespace App\Http\Requests;

use App\Dto\SaveLanguageDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 */
class SaveLanguageRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255|unique:languages,name,' . $this->route('language'),
        ];
    }

    public function getDto(): SaveLanguageDto
    {
        return (new SaveLanguageDto())->setName($this->name);
    }
}

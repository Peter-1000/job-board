<?php

namespace App\Http\Requests;

use App\Dto\SaveOurJobDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $description
 * @property string $company_name
 * @property float $salary
 * @property bool $is_remote
 * @property string $job_type
 * @property string $status
 * @property string|null $published_at
 * @property array $languages
 * @property array $categories
 * @property array $cities
 */
class SaveOurJobRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:255|unique:our_jobs,title,' . $this->route('our_job'),
            'description' => 'required|string|min:5|max:500',
            'company_name' => 'required|string|min:2|max:255',
            'salary' => 'required|numeric|min:0|max:999999,99',
            'is_remote' => 'required|boolean',
            'job_type' => 'required|string|min:2|max:255',
            'status' => 'required|string|min:2|max:255',
            'published_at' => 'nullable|date',
            'languages' => 'required|array',
            'languages.*' => 'required|exists:languages,id',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:categories,id',
            'cities' => 'required|array',
            'cities.*' => 'required|exists:cities,id',
        ];
    }

    public function getDto(): SaveOurJobDto
    {
        return (new SaveOurJobDto())
            ->setTitle($this->input('title'))
            ->setDescription($this->input('description'))
            ->setCompanyName($this->input('company_name'))
            ->setSalary($this->input('salary'))
            ->setIsRemote($this->boolean('is_remote'))
            ->setJobType($this->input('job_type'))
            ->setStatus($this->input('status'))
            ->setPublishedAt($this->input('published_at'))
            ->setLanguages($this->input('languages', []))
            ->setCategories($this->input('categories', []))
            ->setCities($this->input('cities', []));
    }
}

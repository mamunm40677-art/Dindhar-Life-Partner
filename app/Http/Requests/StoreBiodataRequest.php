<?php

namespace App\Http\Requests;

use App\Models\Biodata;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBiodataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if ($user === null) {
            return false;
        }

        $biodata = $this->route('biodata');

        return $biodata instanceof Biodata
            ? $user->can('update', $biodata)
            : $user->can('create', Biodata::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'display_name' => ['required', 'string', 'max:120'],
            'gender' => ['required', Rule::in(['groom', 'bride'])],
            'age' => ['required', 'integer', 'between:18,80'],
            'marital_status' => ['required', Rule::in(['never_married', 'divorced', 'widowed'])],
            'city' => ['required', 'string', 'max:100'],
            'education' => ['required', 'string', 'max:160'],
            'occupation' => ['required', 'string', 'max:120'],
            'about' => ['required', 'string', 'max:2000'],
            'deendar_practice' => ['nullable', 'string', 'max:2000'],
            'published' => ['sometimes', 'boolean'],
        ];
    }
}

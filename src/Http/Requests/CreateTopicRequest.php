<?php

namespace Centagon\Frizzle\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTopicRequest extends FormRequest
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
    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::in(['create', 'update', 'delete', 'noop']),
            ],
            'url' => 'required|url',
            'data' => 'json',
        ];
    }
}

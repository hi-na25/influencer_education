<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'posted_date.required'      => '日付を入力してください',
            'title.required'            => 'タイトルを入力してください',
            'article_contents.required' => '本文を入力してください',
        ];
    }
}

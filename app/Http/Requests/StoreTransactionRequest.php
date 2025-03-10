<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'name'             => 'nullable|string',
            'amount'           => 'required|numeric',
            'type'             => 'required|in:income,expense',
            'category_id'      => 'required|exists:categories,id',
            'description'      => 'nullable|string',
            'transaction_date' => 'nullable|date',
        ];
    }
}

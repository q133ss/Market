<?php

namespace App\Http\Requests\Seller\ProductController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'compound' => 'nullable|string',
            'color' => 'nullable|string',
            'price' => 'required|integer',
            'old_price' => 'nullable|integer',
            'phone' => 'nullable|string',
            'description' => 'required|string',
            'shipping' => 'required|string',
            'in_stock' => 'nullable|in:0,1',
            'city' => 'required|exists:cities,name',
            'qty' => 'required|integer|min:0',
            'type' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите имя',
            'name.string' => 'Введите имя',
            'category_id.string' => 'Выберите категорию',
            'category_id.exists' => 'Указанной категории не существует',
            'compound.string' => 'Состав должен быть строкой',
            'color.string' => 'Цвет должен быть строкой',

            'price.required' => 'Укажите цену',
            'price.integer' => 'Цена должна быть числом',
            'old_price.integer' => 'Старая цена должна быть числом',

            'phone.string' => 'Номер должен быть строкой',
            'description.required' => 'Введите описание',
            'description.string' => 'Описание должно быть строкой',
            'shipping.required' => 'Введите информацию о доставке',
            'shipping.string' => 'Информация о доставке должна быть строкой',

            'city.required' => 'Укажите город',
            'city.exists' => 'Указан неверный город',
            'qty.required' => 'Введите колличество',
            'qty.integer' => 'Колличество должно быть числом',
            'qty.min' => 'Колличество не должно быть меньше 0',

            'type.integer' => 'Неверно указан тип'
        ];
    }
}

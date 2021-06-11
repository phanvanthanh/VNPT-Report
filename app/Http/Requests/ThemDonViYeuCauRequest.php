<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemDonViYeuCauRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ten_don_vi'=>'required|unique:dm_don_vi_yeu_cau',
        ];
    }

    public function messages(){
        return array(
            'ten_don_vi.required'=>'Bạn phải nhập tên nhóm quyền',
            'ten_don_vi.unique'=>'Tên không được trùng',
        );
    }
}

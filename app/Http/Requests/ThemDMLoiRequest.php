<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemDMLoiRequest extends FormRequest
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
            'ten_dm_loi'=>'required',
            'mo_ta'=>'required',
            'yeu_cau'=>'required',
            'id_huong_xu_ly'=>'required',
            'id_loai_danh_muc'=>'required',

        ];
    }

    public function messages(){
        return array(
            'ten_dm_loi.required'=>'Tên danh mục không được để trống!',
        );
    }
}

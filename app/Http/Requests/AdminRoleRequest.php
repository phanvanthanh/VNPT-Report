<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRoleRequest extends FormRequest
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
            'role_name'=>'required',
        ];
    }

    public function messages(){
        return array(
            'role_name.required'=>'Bạn phải nhập tên nhóm quyền',
            'id_don_vi.required'=>'Bạn phải nhập đơn vị',
        );
    }
}

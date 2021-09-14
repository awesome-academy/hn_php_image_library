<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of se rules have multiple versions such
    | as  size rules. Feel free to tweak each of se messages here.
    |
    */

    'accepted' => ':attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :or là :value.',
    'active_url' => ':attribute không phải URL hợp lệ.',
    'after' => ':attribute phải là ngày sau :date.',
    'after_or_equal' => ':attribute phải là ngày trước hoặc bằng :date.',
    'alpha' => ':attribute phải chứa các từ.',
    'alpha_dash' => ':attribute chỉ được chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa các chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'numeric' => ':attribute phải ở giữa :min và :max.',
        'file' => ':attribute phải ở giữa :min và :max kilobytes.',
        'string' => ':attribute phải ở giữa :min và :max chữ.',
        'array' => ':attribute phải ở giữa :min và :max phần tử.',
    ],
    'boolean' => 'trường :attribute phải đúng hoặc sai.',
    'confirmed' => ':attribute xác nhận không phù hợp.',
    'current_password' => 'sai mật khẩu.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'date_equals' => ':attribute phải là một ngày bằng :date.',
    'date_format' => ':attribute không phù hợp với định dạng :format.',
    'different' => ':attribute và :or phải khác.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute phải ở giữa :min và :max chữ số.',
    'dimensions' => ':attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'trường :attribute có giá trị trùng lặp.',
    'email' => ':attribute phải la một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute phải kết thúc bằng một trong following: :values.',
    'exists' => ':attribute đã chọn không có hiệu lực.',
    'file' => ':attribute phải là một tập tin.',
    'filled' => 'trường :attribute phải có một giá trị.',
    'gt' => [
        'numeric' => ':attribute phải lớn hơn :value.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'string' => ':attribute phải lớn hơn :value chữ.',
        'array' => ':attribute phải lớn hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value chữ.',
        'array' => ':attribute phải có :value phần tử hoặc hơn.',
    ],
    'image' => ':attribute phải là một hình ảnh.',
    'in' => ':attribute đã chọn không có hiệu lực.',
    'in_array' => ':attribute trường không tồn tại trong :or.',
    'integer' => ':attribute phải là số nguyên.',
    'ip' => ':attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute phải là một chuỗi JSON hợp lệ.',
    'lt' => [
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn :value chữ.',
        'array' => ':attribute phải nhỏ hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => ':attribute phải nhỏ hơn hoặc bằng :value chữ.',
        'array' => ':attribute phải nhỏ hơn hoặc bằng :value phần tử.',
    ],
    'max' => [
        'numeric' => 'trường :attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => 'trường :attribute không được lớn hơn :max chữ.',
        'array' => ':attribute không được lớn hơn :max phần tử.',
    ],
    'mimes' => ':attribute phải là một tập tin của type: :values.',
    'mimetypes' => ':attribute phải là một tập tin của type: :values.',
    'min' => [
        'numeric' => ':attribute ít nhất phải là :min.',
        'file' => ':attribute ít nhất phải là :min kilobytes.',
        'string' => ':attribute ít nhất phải là :min chữ.',
        'array' => ':attribute ít nhất phải là :min phần tử.',
    ],
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => ':attribute định dạng không hợp lệ.',
    'numeric' => ':attribute phải là một số.',
    'password' => 'sai mật khẩu.',
    'present' => ':attribute phải có mặt.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => 'trường :attribute là bắt buộc.',
    'required_if' => 'trường :attribute được là bắt buộc khi :or là :value.',
    'required_unless' => 'trường :attribute là bắt buộc trừ khi :or trong :values.',
    'required_with' => 'trường :attribute là bắt buộc khi :values là bây giờ.',
    'required_with_all' => 'trường :attribute là bắt buộc khi :values là bây giờ.',
    'required_without' => 'trường :attribute là bắt buộc khi :values không là bây giờ.',
    'required_without_all' => 'trường :attribute là bắt buộc khi không :values là bây giờ.',
    'prohibited' => 'trường :attribute bị cấm.',
    'prohibited_if' => 'trường :attribute bị cấm khi :or là :value.',
    'prohibited_unless' => 'trường :attribute bị cấm trừ khi :or không là :values.',
    'same' => ':attribute must match :or .',
    'size' => [
        'numeric' => ':attribute phải là :size.',
        'file' => ':attribute phải là :size kilobytes.',
        'string' => ':attribute phải là :size chữ.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng một trong số following: :values.',
    'string' => ':attribute phải là một chuỗi.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => 'trường :attribute đã tồn tại.',
    'uploaded' => ':attribute không tải lên được.',
    'url' => ':attribute phải là URL hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using
    | convention "attribute.rule" to name  lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

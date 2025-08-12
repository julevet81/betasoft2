<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute يجب الموافقة على',
    'active_url' => ':attribute يجب أن يكون عنوان URL صالحًا.',
    'after' => ':attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha' => ':attribute يجب أن يحتوي على حروف فقط.',
    'alpha_dash' => ':attribute يجب أن يحتوي على حروف وأرقام وشرطات فقط.',
    'alpha_num' => ':attribute يجب أن يحتوي على حروف وأرقام فقط.',
    'array' => ':attribute يجب أن يكون مصفوفة.',
    'before' => ':attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا قبل أو يساوي :date.',
    'boolean' => ':attribute يجب أن يكون صحيح أو خاطئ',
    'confirmed' => ':attribute كلمة المرور غير مطابقة',
    'date' => ':attribute ليس تاريخاً صالحاً',
    'date_equals' => ':attribute يجب أن يكون تاريخاً مساوياً لـ :date',
    'date_format' => ':attribute لا يتطابق مع الشكل :format',
    'different' => ':attribute و :other يجب أن يكونا مختلفين',
    'digits' => ':attribute يجب أن يتكون من :digits أرقام',
    'digits_between' => ':attribute يجب أن يكون بين :min و :max رقماً',
    'dimensions' => ':attribute أبعاد الصورة غير صالحة',
    'distinct' => ':attribute يحتوي على قيمة مكررة',
    'email' => ':attribute يجب أن يكون بريد إلكتروني صالح',
    'ends_with' => ':attribute يجب أن ينتهي بأحد القيم التالية: :values',
    'exists' => ':attribute المحدد غير صالح',
    'file' => ':attribute يجب أن يكون ملفاً',
    'filled' => ':attribute يجب أن يحتوي على قيمة',

    'gt' => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من :value حرف.',
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أكبر من أو يساوي :value حرف.',
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أكثر.',
    ],
    'image' => ':attribute يجب أن يكون صورة.',
    'in' => ':attribute المحدد غير صالح.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عدد صحيح.',
    'ip' => ':attribute يجب أن يكون عنوان IP صالح.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالح.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالح.',
    'json' => ':attribute يجب أن يكون سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من :value حرف.',
        'array' => ':attribute يجب أن يحتوي على أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value.',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حرف.',
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أقل.',
    ],
    'max' => [
        'numeric' => ':attribute لقد وصلت للحد الاقصي  :max.',
        'file' => ':attribute يجب أن لا يزيد عن :max كيلوبايت.',
        'string' => ':attribute يجب أن لا يزيد عن :max حرف.',
        'array' => ':attribute يجب أن لا يحتوي على أكثر من :max عنصر.',
    ],
    'mimes' => ':attribute يجب أن يكون ملف من نوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملف من نوع: :values.',
    'min' => [
        'numeric' => ':attribute يجيب ان يكون على الاقل  :min.',
        'file' => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'string' => ':attribute يجيب ان يكون على الاقل  :min حرف.',
        'array' => ':attribute يجب أن يحتوي على الأقل على :min عنصر.',
    ],
    'multiple_of' => ':attribute يجب أن يكون من مضاعفات :value.',
    'not_in' => ':attribute المحدد غير صالح.',
    'not_regex' => ':attribute التنسيق غير صالح.',
    'numeric' => ':attribute هذا الحقل يجب أن يكون رقم.',
    'password' => ':attribute كلمة المرور غير صحيحة.',
    'present' => ':attribute يجب أن يكون موجوداً.',
    'regex' => ':attribute يجب الكتابة بشكل صحيح.',
    'required' => ':attribute هذا الحقل مطلوب.',
    'required_if' => ':attribute هذا الحقل مطلوب عندما يكون :other هو :value.',
    'required_unless' => ':attribute هذا الحقل مطلوب ما لم يكن :other في :values.',
    'required_with' => ':attribute هذا الحقل مطلوب عندما يكون :values موجوداً.',
    'required_with_all' => ':attribute هذا الحقل مطلوب عندما تكون :values موجودة.',
    'required_without' => ':attribute هذا الحقل مطلوب عندما تكون :values غير موجودة.',
    'required_without_all' => ':attribute هذا الحقل مطلوب عندما تكون جميع :values غير موجودة.',
    'prohibited' => ':attribute هذا الحقل محظور.',
    'prohibited_if' => ':attribute هذا الحقل محظور عندما يكون :other هو :value.',
    'prohibited_unless' => ':attribute هذا الحقل محظور ما لم يكن :other في :values.',
    'same' => ':attribute و :other يجب أن يتطابقا.',
    'size' => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file' => ':attribute يجب أن يكون :size كيلوبايت.',
        'string' => ':attribute يجب أن يكون :size حرف.',
        'array' => ':attribute يجب أن يحتوي على :size عنصر.',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بأحد القيم التالية: :values.',
    'string' => ':attribute يجب أن يكون سلسلة نصية.',
    'timezone' => ':attribute يجب أن يكون منطقة زمنية صالحة.',
    'unique' => ':attribute هذا الحقل مكرر من قبل.',
    'uploaded' => ':attribute فشل في التحميل.',
    'url' => ':attribute تنسيق غير صالح.',
    'uuid' => ':attribute يجب أن يكون UUID صالح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

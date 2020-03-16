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

    'accepted' => ':attribute harus diterima..',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya dapat berisi huruf, angka, tanda hubung dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh mengandung huruf dan angka.',
    'array' => ':attribute harus berupa array.',
    'before' => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file' => ':attribute harus antara :min dan :max kilobytes.',
        'string' => ':attribute harus antara :min dan :max karakter.',
        'array' => ':attribute harus memiliki antara :min dan :max item maksimum',
    ],
    'boolean' => 'Kolom :attribute harus true atau false.',
    'confirmed' => ':attribute konfirmasi tidak cocok,',
    'date' => ':attribute bukan tanggal yang valid',
    'date_equals' => ':attribute harus merupakan tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar tidak valid..',
    'distinct' => 'Kolom :attribute memiliki nilai duplikat.', // rangkap
    'email' => ':attribute harus berupa alamat email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari yang berikut: :values',
    'exists' => 'dipilih :attribute tidak valid.',
    'file' => ':attribute harus berupa file.',
    'filled' => 'Kolom :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobytes.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file' => ':attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => ':attribute must have :value item atau lebih.',
    ],
    'image' => ':attribute harus berupa gambar.',
    'in' => 'terpilih :attribute tidak valid.',
    'in_array' => 'Kolom :attribute tidak ada di :other.',
    'integer' => ':attribute harus berupa angka.',
    'ip' => ':attribute  harus berupa alamat IP yang valid',
    'ipv4' => ':attribute  harus berupa alamat IPv4 yang valid',
    'ipv6' => ':attribute  harus berupa alamat IPv6 yang valid',
    'json' => ':attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobytes.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file' => ':attribute harus kurang dari atau sama :value kilobyte.',
        'string' => ':attribute harus kurang dari atau sama :value karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute mungkin tidak lebih besar dari :max.',
        'file' => ':attribute mungkin tidak lebih besar dari :max kilobytes.',
        'string' => ':attribute mungkin tidak lebih besar dari :max karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => ':attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'numeric' => ':attribute harus setidaknya :min.',
        'file' => ':attribute harus setidaknya :min kilobytes.',
        'string' => ':attribute harus setidaknya :min karakter.',
        'array' => ':attribute harus setidaknya :min item.',
    ],
    'not_in' => 'dipilih :attribute tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':attribute harus berupa angka',
    'password' => 'kata sandi salah.',
    'present' => 'Kolom :attribute harus ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Kolom :attribute diperlukan.',
    'required_if' => 'Kolom :attribute diperlukan ketika :other adalah :value.',
    'required_unless' => 'Kolom :attribute diperlukan unless :other ada di :values.',
    'required_with' => 'Kolom :attribute diperlukan ketika :values ada.',
    'required_with_all' => 'Kolom :attribute diperlukan ketika :values ada.',
    'required_without' => 'Kolom :attribute diperlukan ketika :values tidak ada',
    'required_without_all' => 'Kolom :attribute diperlukan ketika tidak ada :values.',
    'same' => ':attribute dan :other harus cocok',
    'size' => [
        'numeric' => ':attribute harus :size.',
        'file' => ':attribute harus :size kilobytes.',
        'string' => ':attribute harus :size karakter.',
        'array' => ':attribute harus mengandung :size item.',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari yang berikut: :values',
    'string' => ':attribute harus berupa string.',
    'timezone' => ':attribute harus merupakan zona yang valid.',
    'unique' => ':attribute sudah ada',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => 'Format :attribute tidak valid.',
    'uuid' => ':attribute harus UUID yang valid.',

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

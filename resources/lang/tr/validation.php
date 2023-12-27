<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Doğrulama Dil Satırları
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, doğrulayıcı sınıfı tarafından kullanılan varsayılan hata
    | mesajlarını içerir. Bazı kuralların boyut kuralları gibi birden fazla sürümü vardır.
    | Bu mesajları istediğiniz gibi özelleştirebilirsiniz.
    |
    */

    'accepted' => ':attribute kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL değil.',
    'after' => ':attribute tarihi, :date tarihinden sonra olmalıdır.',
    'after_or_equal' => ':attribute tarihi, :date tarihinden sonra veya eşit olmalıdır.',
    'alpha' => ':attribute yalnızca harf içerebilir.',
    'alpha_dash' => ':attribute yalnızca harf, rakam, tire ve alt çizgi içerebilir.',
    'alpha_num' => ':attribute yalnızca harf ve rakam içerebilir.',
    'array' => ':attribute bir dizi olmalıdır.',
    'before' => ':attribute tarihi, :date tarihinden önce olmalıdır.',
    'before_or_equal' => ':attribute tarihi, :date tarihinden önce veya eşit olmalıdır.',
    'between' => [
        'numeric' => ':attribute :min ile :max arasında olmalıdır.',
        'file' => ':attribute :min ile :max kilobayt arasında olmalıdır.',
        'string' => ':attribute :min ile :max karakter arasında olmalıdır.',
        'array' => ':attribute :min ile :max öğe arasında olmalıdır.',
    ],
    'boolean' => ':attribute alanı true veya false olmalıdır.',
    'confirmed' => ':attribute doğrulaması uyuşmuyor.',
    'date' => ':attribute geçerli bir tarih değil.',
    'date_equals' => ':attribute tarihi, :date tarihine eşit olmalıdır.',
    'date_format' => ':attribute, :format formatına uymuyor.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute :digits basamaklı olmalıdır.',
    'digits_between' => ':attribute, :min ile :max basamak arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahiptir.',
    'distinct' => ':attribute alanı tekrarlanan bir değere sahiptir.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with' => ':attribute şu değerlerden biriyle bitmelidir: :values',
    'exists' => 'Seçilen :attribute geçerli değil.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanı bir değer içermelidir.',
    'gt' => [
        'numeric' => ':attribute, :value değerinden büyük olmalıdır.',
        'file' => ':attribute, :value kilobayttan büyük olmalıdır.',
        'string' => ':attribute, :value karakterden büyük olmalıdır.',
        'array' => ':attribute, :value öğeden fazla olmalıdır.',
    ],
    'gte' => [
        'numeric' => ':attribute, :value değerinden büyük veya eşit olmalıdır.',
        'file' => ':attribute, :value kilobayttan büyük veya eşit olmalıdır.',
        'string' => ':attribute, :value karakterden büyük veya eşit olmalıdır.',
        'array' => ':attribute, en az :value öğe içermelidir.',
    ],
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçerli değil.',
    'in_array' => ':attribute alanı, :other içinde bulunmuyor.',
    'integer' => ':attribute bir tam sayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizisi olmalıdır.',
    'lt' => [
        'numeric' => ':attribute, :value değerinden küçük olmalıdır.',
        'file' => ':attribute, :value kilobayttan küçük olmalıdır.',
        'string' => ':attribute, :value karakterden küçük olmalıdır.',
        'array' => ':attribute, :value öğeden az olmalıdır.',
    ],
    'lte' => [
        'numeric' => ':attribute, :value değerinden küçük veya eşit olmalıdır.',
        'file' => ':attribute, :value kilobayttan küçük veya eşit olmalıdır.',
        'string' => ':attribute, :value karakterden küçük veya eşit olmalıdır.',
        'array' => ':attribute, en fazla :value öğe içermelidir.',
    ],
    'max' => [
        'numeric' => ':attribute, :max değerinden büyük olmamalıdır.',
        'file' => ':attribute, :max kilobayttan büyük olmamalıdır.',
        'string' => ':attribute, :max karakterden büyük olmamalıdır.',
        'array' => ':attribute, en fazla :max öğe içermelidir.',
    ],
    'mimes' => ':attribute, şu türde bir dosya olmalıdır: :values.',
    'mimetypes' => ':attribute, şu türde bir dosya olmalıdır: :values.',
    'min' => [
        'numeric' => ':attribute, en az :min olmalıdır.',
        'file' => ':attribute, en az :min kilobytes.',
        'string' => ':attribute, en az :min karakter olmalıdır.',
        'array' => ':attribute, en az :min öğe içermelidir.',
    ],
    'not_in' => 'Seçilen :attribute geçerli değil.',
    'not_regex' => ':attribute formatı geçersizdir.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'present' => ':attribute alanı mevcut olmalıdır.',
    'regex' => ':attribute formatı geçersizdir.',
    'required' => ':attribute alanı gereklidir.',
    'required_if' => ':other :value ise, :attribute alanı gereklidir.',
    'required_unless' => ':other :values içinde değilse, :attribute alanı gereklidir.',
    'required_with' => ':values mevcut ise, :attribute alanı gereklidir.',
    'required_with_all' => ':values mevcut ise, :attribute alanı gereklidir.',
    'required_without' => ':values mevcut değilse, :attribute alanı gereklidir.',
    'required_without_all' => ':values mevcut değilse, :attribute alanı gereklidir.',
    'same' => ':attribute ve :other aynı olmalıdır.',
    'size' => [
        'numeric' => ':attribute, :size olmalıdır.',
        'file' => ':attribute, :size kilobayt olmalıdır.',
        'string' => ':attribute, :size karakter olmalıdır.',
        'array' => ':attribute, :size öğe içermelidir.',
    ],
    'starts_with' => ':attribute şu değerlerden biriyle başlamalıdır: :values',
    'string' => ':attribute bir metin olmalıdır.',
    'timezone' => ':attribute geçerli bir zaman dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'uploaded' => ':attribute yüklemesi başarısız oldu.',
    'url' => ':attribute formatı geçersiz.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    'password' => [
        'letters' => ':attribute alanı en az bir harf içermelidir.',
        'mixed' => ':attribute alanı en az bir büyük harf ve bir küçük harf içermelidir.',
        'numbers' => ':attribute alanı en az bir sayı içermelidir.',
        'symbols' => ':attribute alanı en az bir sembol içermelidir.',
        'uncompromised' => 'Verilen :attribute veri sızıntısında göründü. Lütfen farklı bir :attribute seçin.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Dil Satırları
    |--------------------------------------------------------------------------
    |
    | Burada, satırları "attribute.rule" konvansiyonunu kullanarak özel doğrulama
    | mesajlarını belirleyebilirsiniz. Bu, belirli bir öznitelik kuralı için hızlı bir
    | özel dil satırı belirtmenizi sağlar.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'özel-mesaj',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Öznitelikleri
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, öznitelik yerine örneğin "email" yerine "E-Posta Adresi"
    | gibi daha anlaşılır bir şey kullanmak için kullanılır. Bu sadece mesajımızı
    | daha açıklayıcı yapmamıza yardımcı olur.
    |
    */

    'attributes' => [],

];

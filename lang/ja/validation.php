<?php

return [
    // max ルールの日本語化
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。',
    ],

    // 他の標準ルールもここに追加できます
    'required' => ':attributeを入力してください。',
    'email'    => '正しいメールアドレス形式で入力してください。',
    'unique'   => 'この:attributeは既に登録されています。',

    // 項目名（名前、カナなど）を日本語に変換する設定
    'attributes' => [
        'name'     => 'ユーザーネーム',
        'kana'     => 'カナ',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
    ],
];

<?php

return [
    'admin' => [
        'page_title' => 'Категорії товарів',
        'name' => 'Назва',
        'title' => 'Заголовок (title)',
        'parent' => 'Батьківська категорія',
        'root' => 'Корінь',
        'info' => 'Інформація',
        'photo' => 'Фото',
        'links' => 'Посилання',
        'url' => 'URL',
        'new_link' => 'Нове посилання',
        'edit_link' => 'Редагування посилання',
        'errors' => [
            'has_child' => 'Дана категорія не може бути перенесена з кореня т.к вона має дочірні категорії!',
            'not_deleted' => 'У вас немає прав на видалення категорії!',
            'slug_not_unique' => 'Сектор URL повинен бути унікальним!'
        ],
        'new_category' => 'Нова категорія',
        'success_updated_text' => 'Категорія вдало відредагована!',
        'success_created_link' => 'Посилання вдало створене!',
        'success_updated_link' => 'Посилання вдало відредаговано!',
    ]
];
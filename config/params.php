<?php

    $parsed_url = parse_url($_SERVER['HTTP_HOST']);
    if(isset($parsed_url['host'])){
        $url = $parsed_url['host'];
    } elseif(isset($parsed_url['path'])) {
        $url = $parsed_url['path'];
    } else {
        $url = '';
    }

    $email = strpos($url, 'superdeal') !== false ? 'partners@superdeal.com.ua' : 'partners@pokupon.ua';

    return [
        'adminEmail'          => $email,
        'commissionType'      => [
            //            'label'   => 'Тип',
            'FREE'    => 'Я размещаюсь бесплатно за высокий % скидки в моей категории',
            'PERCENT' => 'Я плачу коммисиию за продажу',
            'FIXED'   => 'Я плачу фиксированную ставку',
            'fixed'   => 'Я плачу фиксированную ставку',
        ],
        'commissionTypeLabel' => 'Тип',

        'stockStatus'      => [
            'ACTIVE'   => 'Активна',
            'INACTIVE' => 'Модерация',
            'BLOCKED'  => 'Отклонена',
            'FINISHED' => 'Закончена'
        ],
        'stockStatusLabel' => 'Статус Заявки',

        'userStatus'      => [
            'ACTIVE'   => 'Активный',
            'INACTIVE' => 'На модерации',
            'BLOCKED'  => 'Заблокирован'
        ],
        'userStatusLabel' => 'Статус',
        
    ];

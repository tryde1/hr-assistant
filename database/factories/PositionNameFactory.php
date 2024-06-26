<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PositionName>
 */
class PositionNameFactory extends Factory
{
    protected const POSITION_NAMES = [
        'Бэкенд разработчик',
        'Фронтенд разработчик',
        'Веб-разработчик',
        'Фулстек разработчик',
        'Разработчик мобильных приложений',
        'Разработчик приложений',
        'Десктоп разработчик',
        'Релиз менеджер',
        'Разработчик игр',
        'Разработчик баз данных',
        'Инженер встраиваемых систем',
        'HTML-верстальщик',
        'Программист 1С',
        'Системный инженер',
        'ERP-программист',
        'Архитектор программного обеспечения',
        'Технический директор',
        'Архитектор баз данных',
        'Инженер по ручному тестированию',
        'Инженер по автоматизации тестирования',
        'Инженер по обеспечению качества',
        'Инженер по производительности',
        'UX-тестировщик',
        'Аналитик по обеспечению качества',
        'Менеджер по обеспечению качества',
        'Директор по обеспечению качества',
        'Системный аналитик',
        'Аналитик мобильных приложений',
        'Бизнес-аналитик',
        'Гейм-аналитик',
        'Аналитик по данным',
        'Инженер по данным',
        'Программный аналитик',
        'Продуктовый аналитик',
        'BI-разработчик',
        'Веб-аналитик',
        'UI/UX дизайнер',
        'Продуктовый дизайнер',
        'Веб дизайнер',
        'Графический дизайнер',
        'Дизайнер приложений',
        'Дизайнер иллюстратор',
        'Нарративный дизайнер',
        'Дизайнер игр',
        '3d-аниматор',
        'Flash-аниматор',
        'Моушен дизайнер',
        '3d моделлер',
        'Художник компьютерной графики',
        'VUI-дизайнер',
        'Арт директор',
        'Менеджер проекта',
        'Директор проекта',
        'Менеджер продукта',
        'Директор по продукту',
        'Scrum-мастер',
        'Менеджер сообщества',
        'Программный менеджер',
        'Исполнительный директор',
        'Директор по информационным технологиям',
        'Финансовый директор',
        'Генеральный директор',
        'Пентестер',
        'Администратор защиты',
        'Специалист по реверс-инжинирингу',
        'Инженер по безопасности',
        'Антифрод аналитик',
        'Ученый по данным',
        'ML разработчик',
        'Инженер технической поддержки',
        'Менеджер технической поддержки',
        'Директор технической поддержки',
        'Аналитик технической поддержки',
        'Менеджер по обслуживанию клиентов',
        'Директор по обслуживанию клиентов',
        'Модератор',
        'Менеджер по маркетингу',
        'Директор по маркетингу',
        'Маркетинговый аналитик',
        'SEO-специалист',
        'SMM-специалист',
        'Таргетолог',
        'Деврел',
        'PR-менеджер',
        'Директолог',
        'Контекстолог',
        'DevOps-инженер',
        'Системный администратор',
        'Администратор серверов',
        'Администратор баз данных',
        'Сетевой инженер',
        'Администратор сайта',
        'Инженер по доступности сервисов',
        'MLOps-инженер',
        'Технический писатель',
        'Создатель контента',
        'Менеджер по контенту',
        'Директор по контенту',
        'Копирайтер',
        'Менеджер по работе с клиентами',
        'Директор по работе с клиентами',
        'Менеджер по продажам',
        'Директор по продажам',
        'Аналитик продаж',
        'Менеджер по персоналу',
        'Менеджер по найму',
        'Директор по персоналу',
        'Директор по найму',
        'Аналитик по персоналу',
        'Менеджер по обучению и развитию персонала',
        'Менеджер по развитию HR-бренда',
        'Офис менеджер',
        'Бухгалтер',
        'Юрист',
        'Зерокодер',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(self::POSITION_NAMES),
            'salary' => fake()->numberBetween(10000, 1000000),
        ];
    }
}

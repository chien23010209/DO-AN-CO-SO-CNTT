<?php

return [
    // Send one reminder two days before each occasion, avoiding duplicate
    // promotional emails on consecutive days. Set this to [1] when desired.
    'holiday_reminder_days' => [2],

    'holiday_reminder_time' => env('MARKETING_HOLIDAY_REMINDER_TIME', '09:00'),

    // Fixed Gregorian calendar occasions. Lunar New Year dates should be added
    // here by the shop each year because they move on the Gregorian calendar.
    'holiday_campaigns' => [
        ['month_day' => '02-14', 'name' => 'Lễ Tình nhân Valentine'],
        ['month_day' => '03-08', 'name' => 'Ngày Quốc tế Phụ nữ 8/3'],
        ['month_day' => '10-20', 'name' => 'Ngày Phụ nữ Việt Nam 20/10'],
        ['month_day' => '11-20', 'name' => 'Ngày Nhà giáo Việt Nam 20/11'],
        ['month_day' => '12-24', 'name' => 'Giáng sinh'],
    ],
];

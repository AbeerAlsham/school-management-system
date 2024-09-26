<?php

namespace App\Enums;

enum StudentStatus: string
{
    case ناجح = 'ناجح';
    case راسب = 'راسب';
    case مساعد= 'ناجح مع مساعدة';
    case مسجل = 'مسجل';
    case متسرب = 'متسرب';
    case متخرج = 'متخرج';
    case منتقل = 'منتقل';
}


<?php

namespace App\Enums;

enum StudentStatus: string
{
    case ناجح = 'ناجح';
    case راسب = 'راسب';
    case مسجل = 'مسجل';
    case متسرب = 'متسرب';
    case متخرج = 'متخرج';
    case منتقل = 'منتقل';
}


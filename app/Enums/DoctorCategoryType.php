<?php

namespace App\Enums;

enum DoctorCategoryType: string
{
    case ADULT = 'adult';
    case CHILDREN = 'children';
    case BOTH = 'both';
}

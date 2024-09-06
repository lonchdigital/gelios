<?php

namespace App\Enums;

enum PageType: string
{
    case MAINPAGE = 'main_page';
    case ABOUT = 'about';
    case CONTACTS = 'contacts';
    case HOSPITAL = 'hospital';
    case LABORATORY = 'laboratory';
    case BLOG = 'blog';
    case OFFICES = 'offices';
    case OPENING = 'opening';
    case DIRECTIONS = 'directions';
    case PARTNERS = 'partners';
    case PRICES = 'prices';
    case REHABILITATIONCENTER = 'rehabilitation_center';
    case REVIEWS = 'reviews';
    case SHARES = 'shares';
    case SHARESITEM = 'shares_item';
    case SUBCATEGORY = 'subcategory';
    case SURGERY = 'surgery';
    case TEXT = 'text';
    case CHECKUP = 'check_up';
    case CHECKUPITEM = 'check_up_item';
    case TYPICAL = 'typical';
}

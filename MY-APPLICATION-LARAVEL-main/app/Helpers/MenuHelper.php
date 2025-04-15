<?php

namespace App\Helpers;

use Illuminate\Support\Facades\View;

class MenuHelper
{
    public static function updateMenu(&$menuItems)
    {
        foreach ($menuItems as &$item) {
            $activeSection = isset(View::getSections()['active']) ? trim(View::getSections()['active']) : '';
            $elementActiveSection = isset(View::getSections()['element.active']) ? trim(View::getSections()['element.active']) : '';

            if (isset($item['active'])) {
                if ($activeSection === $item['active'] || $elementActiveSection === $item['active']) {
                    $item['activate'] = true;
                } else {
                    $item['activate'] = false;
                }
            }

            if (isset($item['submenu'])) {
                self::updateMenu($item['submenu']);
            }
        }
        return $menuItems;
    }
}

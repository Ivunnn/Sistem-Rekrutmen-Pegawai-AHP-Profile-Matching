<?php

namespace App\Helpers;

class MenuItemHelper
{
    public function isSubmenu($item)
    {
        return isset($item['submenu']);
    }

    public function isHeader($item)
    {
        return isset($item['header']);
    }

    public function isDivider($item)
    {
        return isset($item['divider']);
    }

    public function isLink($item)
    {
        return !$this->isHeader($item)
            && !$this->isDivider($item)
            && !$this->isSubmenu($item)
            && isset($item['url']);
    }

    public function isSearchBar($item)
    {
        return isset($item['type']) && $item['type'] === 'navbar-search';
    }
}

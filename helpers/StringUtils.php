<?php

namespace Algad\Bootstrap\Helpers;

class StringUtils
{

    use \October\Rain\Support\Traits\Singleton;

    function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    function endsWith($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

}

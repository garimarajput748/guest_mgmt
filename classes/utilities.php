<?php
require_once(dirname(__DIR__) . "/path.php");

/**
 * [class utilities]
 */
class utilities
{

    /**
     * @param string $url
     * @param bool $baseUrl
     * This function will redirect page
     */
    static public function showPage($url = '', $baseUrl = true)
    {
        if ($baseUrl) $url = BASE_URL . $url;
        header("location: " .$url);
    }
}

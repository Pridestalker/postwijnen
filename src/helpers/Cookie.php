<?php
namespace App\Helpers;

use App\Exceptions\CookieNotSetException;

class Cookie
{
    public const RECENTLY_VIEWED_KEY = 'recently_viewed';
    
    /**
     * @param int $ID
     *
     * @return void
     */
    public static function setViewCookie($ID): void
    {
        $cookie_name = self::RECENTLY_VIEWED_KEY;
        $cookie_value = $ID;
        $cookie_exp = 604800;
        $cookie_path = '/';
        
        if (!self::hasCookie($cookie_name)) {
            self::setCookie($cookie_name, $cookie_value, $cookie_exp, $cookie_path);
            return;
        }
        
        if (self::getCookie($cookie_name) !== (string) $ID) {
            self::setCookie($cookie_name, $ID, $cookie_exp, $cookie_path);
        }
    }
    
    /**
     * Checks if cookie is set, else throws CookieNotSetException.
     *
     * @return mixed
     * @throws CookieNotSetException
     */
    public static function getViewCookieOrFail()
    {
        $c = self::getViewCookieOrFalse();
        
        if (!$c) {
            $error = new CookieNotSetException('Recently viewed cookie not set');
            $error->throwWPError();
    
            if (Errors::isDebug()) {
                throw $error;
            }
        }
        
        return $c;
    }
    
    /**
     * Check if the cookie is set, or else returns false.
     *
     * @return bool|mixed
     */
    public static function getViewCookieOrFalse()
    {
        return self::getCookie(self::RECENTLY_VIEWED_KEY) ?? false;
    }
    
    /**
     * Returns the cookie if it exists
     *
     * @return mixed|void
     */
    public static function getViewCookie()
    {
        $cookie_name = self::RECENTLY_VIEWED_KEY;
        
        if (self::hasCookie($cookie_name)) {
            return self::getCookie($cookie_name);
        }
    }
    
    /**
     * @param string $name The name of the cookie.
     * @param string $value the value of the cookie.
     * @param int    $exp [optional] <p>
     * This sets the expiration date. use integer to determine the seconds from now.
     * <h2 style="color: #cc0000;">Do not enter epoch value</h2>
     * </p>
     * @param string $path The path on the server in which the cookie will be available on.
     * @param string $domain The (sub)domain that the cookie is available to.
     *
     * @see https://www.php.net/manual/en/function.setcookie.php
     */
    public static function setCookie($name, $value, $exp = 86400, $path = '/', $domain = ''): void
    {
        setcookie(
            $name,
            $value,
            time() + $exp,
            $path,
            $domain
        );
    }
    
    /**
     * Checks if a cookie exists
     *
     * @param string $cookie_name The name of the cookie.
     *
     * @return bool
     */
    public static function hasCookie($cookie_name): bool
    {
        return isset($_COOKIE[$cookie_name]);
    }
    
    /**
     * Gets a cookie from the global $_COOKIE
     *
     * @param string $cookie_name The name of the cookie.
     *
     * @return mixed
     */
    public static function getCookie($cookie_name)
    {
        return $_COOKIE[$cookie_name];
    }
}

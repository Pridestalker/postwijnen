<?php
namespace App\Helpers;


use App\Exceptions\MultiSiteNotEnabledException;
use function get_current_blog_id;

class WP
{
    protected static $sites_cache_but_key = [];
    protected static $stylesheet_dir_cache = null;
    protected static $current_blog_id = null;
    
    /**
     * Returns an array of all public sites.
     *
     * @return array|int
     */
    public static function getAllPublicSitesButCurrent()
    {
        if (function_exists('get_sites')) {
            if (isset(static::$sites_cache_but_key[static::getCurrentBlogId()])) {
                return static::$sites_cache_but_key[static::getCurrentBlogId()];
            }
            
            return static::$sites_cache_but_key[static::getCurrentBlogId()] =  get_sites(
                [
                    'site__not_in'      => static::getCurrentBlogId(),
                    'public'            => 1,
                    'archived'          => 0
                ]
            );
        }
        
        return [];
    }
    
    /**
     * Returns an array of all public sites. Or fails.
     *
     * @return array|int
     * @throws MultiSiteNotEnabledException
     */
    public static function getAllPublicSitesButCurrentOrFail()
    {
        if (!function_exists('get_sites')) {
            $error = new MultiSiteNotEnabledException();
            $error->throwWPError();
            
            if (Errors::isDebug()) {
                throw $error;
            }
        }
        
        return self::getAllPublicSitesButCurrent();
    }
    
    public static function getStylesheetDir()
    {
        if (null !== static::$stylesheet_dir_cache) {
            return static::$stylesheet_dir_cache;
        }
        
        return static::$stylesheet_dir_cache = get_stylesheet_directory();
    }
    
    public static function getCurrentBlogId()
    {
        if (null !== static::$current_blog_id) {
            return static::$current_blog_id;
        }
        
        return static::$current_blog_id = get_current_blog_id();
    }
}

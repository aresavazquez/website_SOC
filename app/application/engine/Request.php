<?php

/**
 * This is under development. Expect changes!
 * Class Request
 * Abstracts the access to $_GET, $_POST and $_COOKIE, preventing direct access to these super-globals.
 * This makes PHP code quality analyzer tools very happy.
 * @see http://php.net/manual/en/reserved.variables.request.php
 */
class Request
{
    public static $post_vars;
    /**
     * Gets/returns the value of a specific key of the POST super-global.
     * When using just Request::post('x') it will return the raw and untouched $_POST['x'], when using it like
     * Request::post('x', true) then it will return a trimmed and stripped $_POST['x'] !
     *
     * @param mixed $key key
     * @param bool $clean marker for optional cleaning of the var
     * @return mixed the key's value or nothing
     */
    public static function post($key, $clean = false)
    {
        if (isset($_POST[$key])) {
            // we use the Ternary Operator here which saves the if/else block
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            return ($clean) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
        }
    }

    /**
     * Returns the state of a checkbox.
     *
     * @param mixed $key key
     * @return mixed state of the checkbox
     */
    public static function postCheckbox($key)
    {
        return isset($_POST[$key]) ? 1 : NULL;
    }

    /**
     * gets/returns the value of a specific key of the GET super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
    }

    public static function put($key){
        if(!self::$post_vars) parse_str(file_get_contents("php://input"), self::$post_vars);
        if(isset(self::$post_vars[$key])){
            return self::$post_vars[$key];
        }
    }

    /**
     * gets/returns the value of a specific key of the COOKIE super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function cookie($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
    }
}

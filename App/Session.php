<?php

class Session
{
    /**
     * Starts a new session if it hasn't been started already.
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Sets a value in the session.
     *
     * @param string $key The key for the session value.
     * @param mixed $value The value to store in the session.
     */
    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Gets a value from the session.
     *
     * @param string $key The key for the session value.
     * @param mixed $default The default value to return if the key does not exist.
     * @return mixed The value from the session or the default value.
     */
    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Checks if a session key exists.
     *
     * @param string $key The key to check.
     * @return bool True if the key exists, false otherwise.
     */
    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Removes a value from the session.
     *
     * @param string $key The key for the session value to remove.
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Destroys the session completely.
     */
    public static function destroy(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

    /**
     * Regenerates the session ID to prevent session fixation attacks.
     *
     * @param bool $deleteOldSession Whether to delete the old session data or not.
     */
    public static function regenerate(bool $deleteOldSession = true): void
    {
        self::start();
        session_regenerate_id($deleteOldSession);
    }

    /**
     * Gets all session data.
     *
     * @return array An associative array of all session data.
     */
    public static function all(): array
    {
        self::start();
        return $_SESSION;
    }
}

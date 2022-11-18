<?php

class SessionFlash
{
    private string $message;

    /**
     * @param string $message
     * 
     * @return void
     */
    public static function set(string $message): void
    {
        $_SESSION['message'] = $message;
    }

    /**
     * @return string
     */
    public static function get(): string
    {
        $message = $_SESSION['message'];
        self::delete();
        return $message;
    }

    /**
     * @return string
     */
    public static function delete(): void
    {
        unset($_SESSION['message']);
    }

    /**
     * @return bool
     */
    public static function exist(): bool
    {
        return isset($_SESSION['message']);
    }
}

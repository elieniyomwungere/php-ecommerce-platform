<?php

class Security {
    const CSRF_TOKEN_NAME = 'csrf_token';

    // Generate a CSRF token
    public static function generateCsrfToken() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION[self::CSRF_TOKEN_NAME])) {
            $_SESSION[self::CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::CSRF_TOKEN_NAME];
    }

    // Verify a CSRF token
    public static function verifyCsrfToken($token) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return hash_equals($_SESSION[self::CSRF_TOKEN_NAME], $token);
    }

    // Sanitize input
    public static function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    // Escape output
    public static function escapeOutput($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

?>
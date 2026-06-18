<?php
/**
 * validate_session.php
 * - Ensures a session is active and the user is logged in.
 * - On failure redirects to the nearest index.php (tries ./index.php then ../index.php),
 *   and falls back to a simple link if headers already sent.
 *
 * Replace the existing validate_session.php with this file.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If not logged in, redirect back to login page instead of dying.
if (!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) {
    // Pick the most-likely index.php relative to this file on the filesystem.
    // Note: this is a filesystem check to choose a reasonable relative URL.
    if (file_exists(__DIR__ . '/index.php')) {
        $redirect = 'index.php';
    } elseif (file_exists(__DIR__ . '/../index.php')) {
        $redirect = '../index.php';
    } else {
        // Last-resort fallback to site root (adjust if you have a different location)
        $redirect = '/';
    }

    // If headers not sent, do a PHP redirect. Otherwise use JS and show a link.
    if (!headers_sent()) {
        header('Location: ' . $redirect);
        exit;
    } else {
        // graceful fallback for cases where this file was included after output
        echo '<!doctype html><html><head><meta charset="utf-8"><title>Redirecting</title></head><body>';
        echo '<p>Access restricted to users. Redirecting to login...</p>';
        echo '<script>window.location.href = ' . json_encode($redirect) . ';</script>';
        echo '<p>If you are not redirected automatically <a href="' . htmlspecialchars($redirect, ENT_QUOTES) . '">click here to login</a>.</p>';
        echo '</body></html>';
        exit;
    }
}
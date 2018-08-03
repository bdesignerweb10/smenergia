<?php
require_once("../../acts/connect.php");

try {
    if(isset($_SESSION)) {
    	session_unset();
    	session_destroy();
    	session_write_close();
    }

    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    	setcookie (session_id(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Expire all of the user's cookies for this domain:
    // give them a blank value and set them to expire
    // in the past
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            $value = trim($parts[1]);
            setcookie($name, $value, time() - 42000);
            setcookie($name, $value, time() - 42000, '/');
            setcookie($name, $value, time() - 42000, '/acts/');
            setcookie($name, $value, time() - 42000, '/admin/');
            setcookie($name, $value, time() - 42000, '/admin/acts/');
        }
        // Explicitly unset this cookie - shouldn't be redundant,
        // but it doesn't hurt to try
        setcookie('PHPSESSID', null, time() - 42000);
    } 
    
    unset($_SERVER['HTTP_COOKIE']);
    $_COOKIE = array();

    header_remove();
    ob_end_flush(); 
    ob_clean();

    echo '{"succeed": true}';

    exit();
} catch(Exception $e) {
    echo '{"succeed": false, "errno": 12000, "title": "Erro ao limpar a sessão!", "erro": "Ocorreu um erro ao limpar a sessão: ' . $e->getMessage() . '"}';
    exit();
}
?>
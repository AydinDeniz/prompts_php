<?php
session_start();

define('COOKIE_LIFETIME', 60 * 60 * 24 * 30); // 30 days for "remember me"
define('SESSION_LIFETIME', 60 * 30); // 30 minutes for session cookie

// Placeholder function for user verification; replace with actual user validation
function verifyUser($username, $password) {
    // Assume a simple validation for demo purposes
    return ($username === 'user' && $password === 'password123');
}

// Function to handle login
function login($username, $password, $rememberMe = false) {
    if (verifyUser($username, $password)) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();
        
        // Set "remember me" cookie if selected
        if ($rememberMe) {
            setcookie('remember_me', $username, time() + COOKIE_LIFETIME, '/', '', true, true);
        } else {
            setcookie('remember_me', '', time() - 3600, '/', '', true, true); // Clear if not set
        }
        return true;
    }
    return false;
}

// Function to check if the user is authenticated
function isAuthenticated() {
    // Check session
    if (!empty($_SESSION['authenticated']) && (time() - $_SESSION['last_activity'] <= SESSION_LIFETIME)) {
        $_SESSION['last_activity'] = time(); // Update activity time
        return true;
    }
    
    // Check "remember me" cookie
    if (!empty($_COOKIE['remember_me'])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $_COOKIE['remember_me'];
        $_SESSION['last_activity'] = time();
        return true;
    }

    return false;
}

// Function to log out the user
function logout() {
    // Clear session
    $_SESSION = [];
    session_destroy();
    
    // Clear cookies
    setcookie('remember_me', '', time() - 3600, '/', '', true, true);
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Sample usage
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']);

    if (login($username, $password, $rememberMe)) {
        header("Location: dashboard.php"); // Redirect to protected area
        exit();
    } else {
        echo "Invalid credentials.";
    }
}

// Logout action
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}

// Check authentication on each page load
if (!isAuthenticated()) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}
?>

<?php
    
    // start a session for a user
    function startSession($userId=null){
        // generate a session id
        $sessionId = bin2hex(random_bytes(32));

        // expires after 1 hour
        $expiresAt = date('Y-m-d H:i:s', time() + 3600);

        // secure cookie
        setcookie('session_id', $sessionId, $expiresAt, "/", "", false, true);
        
        // return session id
        return $sessionId;
    }

    // validate session
    function validateSession(){
        // if no cookie, no session, return false 
        if (!isset($_COOKIE['session_id'])) {
            return false;
        }

        // get session id from cookie
        $sessionId = $_COOKIE['session_id'];

        // check if session id is valid
        $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE session_id = ? AND expires_at >NOW()");
        $stmt->execute([$sessionId]);
        $session = $stmt->fetch();

        if ($session) {
            return true;
        } else {
            return false;
            // session expired or invalid
        }
    }

    // destroy session
    function destroySession(){
        // TODO remove session from storage

        // TODO remove cookie
    }
    
?>
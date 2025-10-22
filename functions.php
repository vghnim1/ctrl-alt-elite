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
        // TODO if no cookie, no session, return false 

        // get session id from cookie
        $sessionId = $_COOKIE['session_id'];

        // TODO check if session id is valid
    }

    // destroy session
    function destroySession(){
        // TODO remove session from storage

        // TODO remove cookie
    }
    
?>
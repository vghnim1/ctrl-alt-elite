<?php
    
    // start a session for a user
    function startSession($userId=null){
        // TODO generate a session id
        // TODO expires after 1 hour
        // TODO secure cookie
        // TODO return session id
    }

    // validate session
    function validateSession(){
        // TODO if no cookie, no session, return false 

        // get session id from cookie
        $sessionId = $_COOKIE['session_id'];

        // TODO check if session id is valid
    }


    
?>
<?php

##############################################################################\
###############################################################################
## Author : Mohammad Anzawi from phptricks.org                               ##
## License : MIT                                                             ##
##                                                                           ##
## see all my free and open source php libraries and classes on github:      ##
## https://github.com/anzawi                                                 ##
##                                                                           ##
## visit my blog -> http://phptricks.org                                     ##
##                                                                           ##
###############################################################################
##                 Please Dont Remove this comment block.                    ##
##                                                                           ##
###############################################################################
##############################################################################/
class Csrf
{

    // the session and field name
    private $_tokenName = "_token";

    // we dont need a doblucate object just one - instanse - 
    private static $__obj = null;

    private function __construct()
    {
        // check if session is not started , start session
        if (session_id() == '') {
            session_start();
        }

        // generate token 
        $this->generate();
    }

    // initilize the class
    public static function init()
    {
        // check if object already created ro not
        if (!isset(self::$__obj) || is_null(self::$__obj)) {
            self::$__obj = new Csrf(); // create new object
        }

        return self::$__obj;
    }


    /**
      * check if token (CSRF) generated or not
      * precautionary measure because we generated in __construct function
    */
    private function checkIfTokenIsGenerated()
    {
        return isset($_SESSION[$this->_tokenName]);
    }

    /**
      * generate token value
    */
    public function generate()
    {
        // check if token has been generated - if not generate a new one. 
        // otherwise return old token
        // to allow multi forms in same page
        // if we dont do that , only last form can be passed from token check.
        if (!$this->checkIfTokenIsGenerated())
            $_SESSION[$this->_tokenName] = sha1(uniqid() . rand() * time());

        return $_SESSION[$this->_tokenName];
    }

    /**
      * get token value
    */ 
    public function getToken()
    {
        // check if its not generated , if not generate a new one
        if(!$this->checkIfTokenIsGenerated())
            return $this->generate();

        return $_SESSION[$this->_tokenName];
    }


    /**
      * this method to check if submited token is valid or not.
      * its accept (optional) paramener, this parameter -> value of submited token
      * if you dont sent the value, we get submited token value if its exist.
    */
    public function checkToken($value = '')
    {
        // check if value paramenter is not send 
        // and token value is not submited or token is not generated
        // return bool(false)
        if(!$value && !$this->submitedToken() || !$this->checkIfTokenIsGenerated())
        {
            return false;
        }

        // if token value not sent so the value is the submited value 
        $value = $value ? $value : $_POST[$this->_tokenName];
        // (bool) if token submited value is equal token in session so true otherwise false
        $valid = $value === $_SESSION[$this->_tokenName];

        // delete (remove, destroy, unset) current token value from session
        $this->destroy();
        // return (bool)
        return $valid;
    }

    // this method if we want to kill page if token is not match our session
    /**

How to Use :::::

if($token->checkToken())
{
 // evrything is OK , process last action 
}
else
{
    // the token is not match , something wrong - CSRF Attack
}
-----------------------

OR ---- 

$token->ValidOrDie();
 // evrything is OK , process last action 
 // because if anything is wrong the page was killed from ValidOrDie() method

    */
    public function ValidOrDie()
    {
        if(!$this->checkToken()) die("Oops, invalid server request . the CSRF not Matched our storage");
    }

    // auto generate input field from form in html page
    public function csrfField()
    {
        return "<input type='hidden' name='" . $this->_tokenName . "' value='" . $this->getToken() . "'>";
    }

    // delete token session
    public function destroy()
    {
        unset($_SESSION[$this->_tokenName]);
    }

    // here we just check if token value is submited ($_GET or $_POST only)
    private function submitedToken()
    {
        $token = false;

        if(isset($_POST[$this->_tokenName]))
            $token = $_POST[$this->_tokenName];
        elseif(isset($_GET[$this->_tokenName]))
            $token = $_GET[$this->_tokenName];

        return $token;
    }
}

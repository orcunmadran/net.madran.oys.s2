<?php

if ( !defined( 'INC_DIR' ) ) {
	die( 'hacking attempt' );
}

/************************************************************************/
//!!! IMPORTANT NOTE
//!!! FlashChat 4.4.0 and higher support a new user role: ROLE_MODERATOR
//!!! Please edit the getUser and getRoles function if you need use of
//!!! the new moderator role. This change has not yet been applied.
/************************************************************************/

$e107path = realpath(dirname(__FILE__) . '/../../../') . '/';

@require_once($e107path . 'e107_config.php');

if ( !@defined( 'MPREFIX' ) ) {
	@define( 'MPREFIX', $mySQLprefix );
}

class E107CMS {
    var $user = null;
    var $userid = null;

    var $getE107UserInfoStmt;
    var $getUserStmt;
    var $getUsersStmt;

    function E107CMS() {

        $this->getE107UserInfoStmt = new Statement("SELECT user_id as id, user_loginname AS login, user_admin, user_password as password FROM " . MPREFIX . "user WHERE user_loginname=? LIMIT 1");

        $this->getUserStmt = new Statement("SELECT user_id as id, user_loginname AS login, user_admin, user_password as password FROM " . MPREFIX . "user WHERE user_id=? LIMIT 1");

        $this->getUsersStmt = new Statement("SELECT user_id as id, user_loginname AS login, user_admin, user_password as password FROM " . MPREFIX . "user ORDER BY user_loginname");
    }

    function isLoggedIn() {
        return (USER ? USERID : null);
    }

    function login($login, $password) {

      $rv = null;

      if(($rs = $this->getE107UserInfoStmt->process($login)) && ($rec = $rs->next()) && ($rec['password'] == md5($password))) {

		$this->user = array(
						    'id' => $rec['id'],
						    'login' => $rec['login'],
						    'roles' => isAdmin($rec['user_admin'])
						    );
		$rv = $rec['id'];
      }

      return $rv;
    } // ends function

    function logout(){
        //$this->user = null;
    }

    function getUser($userid) {
            if($userid) {
                $rs = $this->getUserStmt->process($userid);
                if ($rs && $rs->hasNext()) {
                    $rec = $rs->next();
                    $rec['roles'] = isAdmin($rec['user_admin']);
                    return $rec;
                }

            } else {
                return null;
            }
    }

    function getUsers() {
        if ($rs = $this->getUsersStmt->process()) {
            return $rs->next();
        }
        else {
            return null;
        }
    }

    function getUserProfile($userid) {

		global $e107path;

		// a little hack since e_HTTP constant is not available to us
		// (since we're using e107_config.php instead of class2.php to get server vars)

		$path = str_replace(realpath($_SERVER["DOCUMENT_ROOT"]), '', $e107path);
		$path = '/' . str_replace( '\\', '/', $path );
		$path = str_replace( '//', '/', $path );

		$profile_url = "http://" . $_SERVER["HTTP_HOST"] . $path . 'user.php?id.' . $userid;

        return($profile_url);
    }

	function userInRole($userid, $role) {
		if($user = $this->getUser($userid)) {
			return ($user['roles'] == $role);
		}
		return false;
	}

	function getGender($userid){
		// 'M' for Male, 'F' for Female, NULL for undefined
		return NULL;
  	}
}

function isAdmin($admin)
{
    switch($admin)  {
        case 0: $roles = ROLE_USER; break;
        case 1: $roles = ROLE_ADMIN; break;
        default: $roles = ROLE_USER; break;
    } // end switch
    return $roles;
}

$GLOBALS['fc_config']['db'] = array(
	'host' => $mySQLserver,
	'user' => $mySQLuser,
	'pass' => $mySQLpassword,
	'base' => $mySQLdefaultdb,
	'pref' => MPREFIX . 'flashchat'
);

foreach($GLOBALS['fc_config']['languages'] as $k => $v) {
    $GLOBALS['fc_config']['languages'][$k]['dialog']['login']['moderator'] = '';
}


$GLOBALS['fc_config']['cms'] = new E107CMS();

?>
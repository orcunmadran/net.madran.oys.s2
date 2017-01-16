<?php
			//Admins cannot be ignored
			if(ChatServer::userInRole($ignoredUserID, ROLE_ADMIN)) return;
			if(ChatServer::userInRole($ignoredUserID, ROLE_MODERATOR)) return;

			//User cannot ignore him self
			if($this->userid == $ignoredUserID) return;
			
			$this->sendToUser($ignoredUserID, new Message('ignu', $this->userid, null, $txt));

			$stmt = new Statement("SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}ignors WHERE userid=? AND ignoreduserid=?");
			if(($rs = $stmt->process($this->userid, $ignoredUserID)) && $rs->hasNext()) {
				$stmt = new Statement("UPDATE {$GLOBALS['fc_config']['db']['pref']}ignors SET created=NOW() WHERE userid=? AND ignoreduserid=?");
				$stmt->process($this->userid, $ignoredUserID);
			} else {
				$stmt = new Statement("INSERT INTO {$GLOBALS['fc_config']['db']['pref']}ignors (created, userid, ignoreduserid) VALUES (NOW(), ?, ?)");
				$stmt->process($this->userid, $ignoredUserID);
			}
?>
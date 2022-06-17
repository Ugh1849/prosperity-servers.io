<?php
if (isset($_POST['steamLogin']) || isset($_GET['openid_mode'])){
	if( isset($_SESSION["logged"]) ) {
		return;
	}

	require 'openid.php';
	try {
		require 'SteamConfig.php';
		$openid = new LightOpenID($steamauth['domainname']);
		
		if(!$openid->mode) {
			$openid->identity = 'https://steamcommunity.com/openid';
			header('Location: ' . $openid->authUrl());
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
				$id = $openid->identity;
				$ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
				preg_match($ptn, $id, $matches);
				
				$steamid = $matches[1];

				if( !isset($GLOBALS["allowedUsers"][$steamid]) ) {
					$_SESSION["errors"][] = __("login.notAllowed");
					redirect("/login");
					exit();
				}

				$_SESSION['steamid'] = $steamid;
				$_SESSION["logged"] = true;
				if (!headers_sent()) {
					header('Location: '.$steamauth['loginpage']);
					exit;
				} else {
					?>
					<script type="text/javascript">
						window.location.href="<?=$steamauth['loginpage']?>";
					</script>
					<noscript>
						<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
					</noscript>
					<?php
					exit;
				}
			}
		}
	} catch(ErrorException $e) {
		echo $e->getMessage();
	}
}
// Version 4.0

?>

<?php
if(isset($_GET['a'])){
		$a = unserialize(base64_decode($_GET['a']));
		// var_dump($a);
		require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
		$user = new user($hammer);
		$user->getByEmail($a['email']);
		if(($a['email']=="kyle@noteforge.com")||($a['email']=="cassie.keogh@ndsu.edu")){
			?>
			<script>
				if(typeof(Storage) !== "undefined") {
				localStorage.setItem("kvtoken", "<?php echo $user->row['hash'];?>");
				window.location = '/';
			} else {
				document.write('Sorry! No Web Storage support. Please use a different browser or machine');
			}
			</script>
			<?php
		}else{
			echo "<script>window.location = '//kv.fyi';</script>";
		}
		// die();
		/*
	?>
	<script>
	//Get the token out of storage
		if(typeof(Storage) !== "undefined") {
			if(localStorage.getItem("kvtoken")==="CRM4ECLION03PMXI1LM369UJL"){
				window.location = '/app/';
			}else{
			}
		} else {alert('KDV cannot be configured on this device.');}
	</script>
	<?php
	*/
}else{
	//Load Hammer and force a login.
    $options['vanguard']=TRUE;
    $options['vanguardLogin']="";
    $options['vanguardAccess']="X";
	$options['vanguardLoginURL']="https://vanguard.kylevanderburg.net/";
}
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
?>

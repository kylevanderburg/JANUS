<?php

/*
NoteForge Hammer
by Kyle Vanderburg, in Poplar Bluff and Springfield, Missouri, and Norman, OK.
Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
All code copyright Kyle Vanderburg

This code is a module that requires the Hammer Core in order to fully work.
*/

$action=$hammer->location[1];

$hammer->setHS(1);
$hammer->getUserFromHash("CRM4ECLION03PMXI1LM369UJL");

$hr = new vio_musicdirector($hammer);
if(isset($hammer->location[2])){$hr->getByID($hammer->location[2]);}

echo "<div class=\"hh text-center\"><h1>Music Directors</h1></div>";
// $hr->toolbar();
echo "<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"Liszt Toolbar\"><div class=\"btn-group me-2\" role=\"group\" aria-label=\"Directors\"><a href=\"/musicdirectors/\" class=\"btn btn-outline-liszt btn-lg active\" title=\"Index\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"><i class=\"fa-light fa-square-list\"></i></a><a href=\"/musicdirectors/new/\" class=\"btn btn-outline-liszt btn-lg\" title=\"New\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"><i class=\"fa-light fa-plus\"></i></a><a href=\"/musicdirectors/import/\" class=\"btn btn-outline-liszt btn-lg\" title=\"import\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"><i class=\"fa-light fa-cloud-up\"></i></a></div></div><br />";


echo "<br />";
// if(!isset($_GET["action"])){$action="default";}else{$action=$_GET["action"];}

switch ($action){
	case "new":
	case "insert":
	case "modify":
	case "write":
		//Insert new stuff
		if($action==="insert"){$hr->create();}
		if(($action==="insert") xor ($action==="write")){
			if(!isset($hr->id)){$hr->id=$_POST['id'];}
			unset($_POST['filter']);
			$hr->update($_POST);
		}
		if($action=="modify"){$hr->id=$hammer->location['item'];}
		if($action=="insert"||$action=="modify"||$action=="write"){$hr->get();}

		$hr->saveCloseHandler($_POST);
		$hr->savedAlert($action); ?>
		<h2><?php echo $hammer->unsanitize($hr->row['firstname']) . " " . $hammer->unsanitize($hr->row['lastname']); ?></h2>

		<form name="<?php echo $hr->page; ?>" action="/musicdirectors/<?php if($action=="new"){echo "insert";}elseif(($action=="modify")||($action=="insert")||($action=="write")){echo "write";} ?>/" method="post" enctype="multipart/form-data">

		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<?php $hammer->writeTab("Details",1);?>
				<?php if($action!="new"){?><?php $hammer->writeTab("Audit");?><?php } ?>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php $hammer->writeTabHeader("Details",1);?><br />
					<table class="table">
						<tr><td><?php $hr->textinput("name","Name");?></td></tr>
						<tr><td><?php $hr->textinput("hs","High School");?></td></tr>
						<tr><td><?php $options['type']="email";$hr->textinput("email","E-mail");?></td></tr>
						<tr><td><?php $hr->textinput("address1","Address");?></td></tr>
						<tr><td><?php $hr->textinput("address2","");?></td></tr>
						<tr><td>
							<div class="form-group form-group-lg">
								<b>City, State, ZIP</b><br />
								<div class="col-md-5">
								<input id="<?php echo $hr->page;?>-city" type="text" name="city" value="<?php echo $hammer->unsanitize($hr->row['city']); ?>" class="form-control lz-field">
								</div>
								<div class="col-sm-4">
								<select id="<?php echo $hr->page;?>-state" name="state" class="form-control lz-field">
								<?php foreach($hr->stateList() as $abb=>$state){echo "<option value=\"".$abb."\"";if($hr->row['state']==$abb){echo " selected";}echo ">".$state."</option>";}

								// echo $hr->row['state'];?>
								</select>
								</div>
								<div class="col-sm-3">
								<input id="<?php echo $hr->page;?>-zip" type="text" name="zip" value="<?php echo $hammer->unsanitize($hr->row['zip']); ?>" class="form-control lz-field">
								</div>
							</div>
						</td></tr>
						<tr><td>&nbsp;</td></tr>
                        <tr><td><?php $hr->checkbox("band","Band");?></td></tr>
                        <tr><td><?php $hr->checkbox("choir","Choir");?></td></tr>
                        <tr><td><?php $hr->checkbox("orch","Orchestra");?></td></tr>
						<tr><td><?php unset($options);$options['inputextra']="data-number=\"".$hammer->unsanitize($hr->row['phone'])."\" data-country=\"US\"";$hr->textinput("phone","Phone",$options);?></td></tr>
						<tr><td><?php unset($options);$options['inputextra']="data-number=\"".$hammer->unsanitize($hr->row['cell1'])."\" data-country=\"US\"";$hr->textinput("cell1","Cell Phone 1",$options);?></td></tr>
						<tr><td><?php unset($options);$options['inputextra']="data-number=\"".$hammer->unsanitize($hr->row['cell2'])."\" data-country=\"US\"";$hr->textinput("cell2","Cell Phone 2",$options);?></td></tr>
						<tr><td><?php unset($options);$options['inputextra']="data-number=\"".$hammer->unsanitize($hr->row['work1'])."\" data-country=\"US\"";$hr->textinput("work1","Work Phone 1",$options);?></td></tr>
						<tr><td><?php unset($options);$options['inputextra']="data-number=\"".$hammer->unsanitize($hr->row['work2'])."\" data-country=\"US\"";$hr->textinput("work2","Work Phone 2",$options);?></td></tr>
						<tr><td><?php $options['type']="email";$hr->textinput("email2","Alternate E-mail");?></td></tr>
                        <tr><td>
							<?php if(!$hr->row['last_updated']){$hr->row['last_updated']=$hammer->getHT('sqlts');}else{}
                            $hr->dateTimePicker("last_updated","last_updated");?>
                        </td></tr>
                        <tr><td>
							<?php if(!$hr->row['last_contacted']){$hr->row['last_contacted']=$hammer->getHT('sqlts');}else{}
                            $hr->dateTimePicker("last_contacted","last_contacted");?>
                        </td></tr>
                        <tr><td>
							<div class="form-group form-group-lg">
								<label for="<?php echo $hr->page;?>-mailstatus">Mail Verification</label><br />
								<?php
								unset($options);
								$options['2']="Invalid";
								$options['1']="Valid";
								$options['3']="Catch-All";
								$options['0']="Unverified";
								$hr->radio("mailstatus",$options,$hr->row['mailstatus']); ?>
							</div>
						</td></tr>
						<tr><td><?php $hr->checkbox("archived","Archived");?></td></tr>
					</table>
				<?php $hammer->writeTabFooter();
				
				$hammer->writeTabHeader("Audit"); echo "<br />"; include "audit.php"; $hammer->writeTabFooter(); ?>
			</div>
		</div>
		<br />
		<input type="hidden" name="id" value="<?php echo $hr->row['id']; ?>">

		<div class="text-center">
		<div class="btn-group btn-group-lg">
			<?php echo $hr->saveButton();echo $hr->savecloseButton(); echo $hr->deleteButton($hr->id,$hr->row['firstname']." ".$hr->row['lastname']); ?>
		</div>
		</div>
		</form>
		<script><?php $hr->deleteHandler(); ?></script>
		<br />
	<?php
	break;
	
	case "import":
		if(!isset($_FILES["file"]["tmp_name"])){
			?>
			In order for this utility to work, the CSV file must have the following headings: name, hs, address1, city, state, email, band, choir, orchestra.
			<form name="csv" action="/musicdirectors/import/" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr><td><b>File</b></td><td><input type="file" name="file" class="form-control lz-field"></td></tr>
			</table>
			<br />
			<div class="hammer-buttonrow" align="center"><?php $hr->uploadButton(); ?></div>
			<?php
		}else{
			//Get File and Info
			$tmp_name = $_FILES["file"]["tmp_name"];
			
			//Build Array
			$array = $hr->csvArrayHeader($tmp_name);

			//Cycle Array
			foreach($array as $person){
                echo "<br />".$person['name']." should be added";$i++;
                $hr->create();
                var_dump($_POST);

                if(!empty($person['band'])){$person['band']=1;}
                if(!empty($person['choir'])){$person['choir']=1;}
                if(!empty($person['orch'])){$person['orch']=1;}

                print_r($person);echo "<br /><br />";
                $hr->update($person);
                unset($person);
			}

			//delete file
			unlink($tmp_name);

			echo "<br /><br />Parsed!";
		}
	break;

	case "export":
		$hr->export("musicdirectors");
	break;

    case "verifyemail":
        $hammer->debug();
		foreach($hr->q("`mailstatus`='2' AND `email` <> ''","LIMIT 1") as $row){
			var_dump($row);
			$status = $hammer->verifyEmail($row['email']);
			if($status>0){
				$push['mailstatus'] = $status;
				$hr->getByID($row['id']);
				$hr->update($push);
				unset($push);
			}
		}
		?>
		<script>
		setTimeout(function(){
		window.location.reload(1);
		}, 35000);
</script>
		<?php
    break;

	case "invalid":
		echo "<table class=\"table\">";
		foreach($hr->q("`mailstatus`='2'") as $row){
			// var_dump($row);
			if($row['band']){$jobs = "Band ";}
			if($row['choir']){$jobs .= "Choir ";}
			if($row['orch']){$jobs .= "Orch ";}
			if($row['state']=="MN"){$url="mshsl.org";}
			if($row['state']=="ND"){$url="ndhsaa.com";}
			echo "<tr><td><a href=\"/musicdirectors/modify/".$row['id']."/\">".$row['hs']."</a></td><td>".$row['city']." ".$row['state']."</td><td>".$jobs."</td><td><a href=\"https://www.google.com/search?q=".str_replace(" ","%20",$row['hs']."%20".$row['city'])."+site%3A".$url."&ie=UTF-8&oe=UTF-8\" class=\"btn btn-success\">Search</a></td></tr>";
			unset($jobs);
		}
	break;
	
	default:
		echo "<div role=\"tabpanel\">
			<ul class=\"nav nav-tabs\" role=\"tablist\">";
		$hammer->writeTab("All",1);
		$hammer->writeTab("Archived");
		echo "</ul>";
		echo "<div class=\"tab-content\">";

		//View All
		$hammer->writeTabHeader("All",1);
			$hr->listIndexWrapper("`archived`<>1","ORDER BY name DESC",1,"50","",$hammer->getHD());
		$hammer->writeTabFooter();

		// Archived
		$hammer->writeTabHeader("Archived");
			$hr->listIndexWrapper("`archived`=1","ORDER BY name DESC",1,"50","",$hammer->getHD());
		$hammer->writeTabFooter();

		echo "</div><!--tab-content-->";
		echo "</div><!--tabpanel-->";
		?>
		<script>
			<?php if($hammer->demo>0){ ?>
			//New Remove Table Row
			document.addEventListener("click", function (event) {
				if (event.target.classList.contains("lz-delete-row")) {
					var button = event.target;

					// Update the button and parent row classes immediately
					var row = button.closest('.lz-row');
					if (row) {
						row.classList.add('table-secondary');
					}
					button.classList.add('btn-secondary');
					button.setAttribute("disabled", "disabled");
					button.classList.remove('lz-delete-row', 'btn-warning');
					button.innerHTML = '<i class="fa fa-times"></i> Restricted';

					// Revert changes after 2 seconds
					setTimeout(function () {
						if (row) {
							row.classList.remove('table-secondary');
						}
						button.innerHTML = '<i class="fa fa-trash"></i>';
						button.classList.add('lz-delete-row', 'btn-warning');
						button.classList.remove('btn-secondary');
						button.removeAttribute("disabled");
					}, 2000);
				}
			});

			<?php }else{ ?>
				//New Remove Table Row
				document.addEventListener("click", function (event) {
					// Handle ".lz-delete-row" button click
					if (event.target.classList.contains("lz-delete-row")) {
						var button = event.target;

						// Update the button and parent row classes immediately
						var row = button.closest('.lz-row');
						if (row) {
							row.classList.add('table-danger');
						}
						button.classList.add('lz-delete-row-confirm', 'btn-danger');
						button.classList.remove('lz-delete-row', 'btn-warning');
						button.innerHTML = '<i class="fa fa-check"></i> Confirm';

						// Revert changes after 2 seconds
						setTimeout(function () {
							if (row) {
								row.classList.remove('table-danger');
							}
							button.innerHTML = '<i class="fa fa-trash"></i>';
							button.classList.add('lz-delete-row', 'btn-warning');
							button.classList.remove('lz-delete-row-confirm', 'btn-danger');
						}, 2000);
					}

					// Handle ".lz-delete-row-confirm" button click
					if (event.target.classList.contains("lz-delete-row-confirm")) {
						var button = event.target;
						var id = button.getAttribute("data-id");
						var friendly = button.getAttribute("data-friendly");

						// Check for dependencies via POST request
						var data = "page=" + encodeURIComponent('<?php echo get_class($hr); ?>') +
								"&action=" + encodeURIComponent('getDependencies') +
								"&site=" + encodeURIComponent('<?php echo $hammer->getHA(); ?>') +
								"&record=" + encodeURIComponent(id) +
								"&user=" + encodeURIComponent('<?php echo $hammer->user['hash']; ?>') +
								"&session=" + encodeURIComponent('<?php echo $hammer->lzsession; ?>');

						orchestrate("//api.liszt.cloud/orchestrate.php", data, function (result) {
							if (result < 1) {
								// No dependencies, proceed to delete
								var deleteData = "page=" + encodeURIComponent('<?php echo get_class($hr); ?>') +
												"&action=" + encodeURIComponent('destroy') +
												"&site=" + encodeURIComponent('<?php echo $hammer->getHA(); ?>') +
												"&record=" + encodeURIComponent(id) +
												"&user=" + encodeURIComponent('<?php echo $hammer->user['hash']; ?>');

								orchestrate("//api.liszt.cloud/orchestrate.php", deleteData, function () {
									var row = button.closest('.lz-row');
									if (row) {
										row.remove(); // Remove the row from the DOM
									}
								});
							} else {
								// Alert the user about existing dependencies
								alert("This person (" + friendly + ") has checkouts, convocation credit, or other checkouts that must be cleared before deletion.");
							}
						});
					}
				});

			<?php } ?>
		</script>

		<?php
	break;
}	?>
<?php
/*
NoteForge Hammer
	by Kyle Vanderburg, in Poplar Bluff and Springfield, Missouri, and Norman, OK.
HAMMER Opportunity Engine V.1.4
hammer-opp.php last modified 06/15/13 KV
Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
All code copyright Kyle Vanderburg

This code is a module that requires the Hammer Core in order to fully work.
*/
$hr = new vio_timeline_event($hammer);
$tl = new vio_timeline($hammer);
$hammer->setHS(1);
$hammer->getUserFromHash("CRM4ECLION03PMXI1LM369UJL");

// $hr->restrict();
// $hammer->debug();
// var_dump($hammer->location);
$action=$hammer->location[1];

echo "<div class=\"hh text-center\"><h1>Timeline Events</h1></div>";
// $hr->toolbar();
echo "<div class=\"btn-toolbar\" role=\"toolbar\" aria-label=\"Liszt Toolbar\"><div class=\"btn-group me-2\" role=\"group\" aria-label=\"Deliveries\"><a href=\"/timeline-events/\" class=\"btn btn-outline-liszt btn-lg active\" title=\"Index\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"><i class=\"fa-light fa-square-list\"></i></a><a href=\"/timeline-events/new/\" class=\"btn btn-outline-liszt btn-lg\" title=\"New\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"><i class=\"fa-light fa-plus\"></i></a></div></div><br />";

switch ($action){
	case "new":
	case "insert":
	case "modify":
	case "write":
	//var_dump($_POST);
		//Insert new stuff
		if($action==="insert"){$hr->create();}

		if(($action==="insert") xor ($action==="write")){
			if(!isset($hr->id)){$hr->id=$_POST['id'];}
			unset($_POST['options']);
			$hr->update($_POST);
		}

		if($action=="modify"){$hr->id=$hammer->location[2];}

		if($action=="insert"||$action=="modify"||$action=="write"){$hr->get();}
	
		if(($action=="insert" OR $action=="write") AND isset($_POST['saveclose'])){
			echo "<script>location.href = \"/".$hr->page."/\"</script>"; 
		} 
		$hr->savedAlert($action); ?>
		<form name="<?php echo $hr->page; ?>" action="/<?php echo $hr->page;?>/<?php if($action=="new"){echo "insert";}elseif(($action=="modify")||($action=="insert")||($action=="write")){echo "write";} ?>/" method="post" enctype="multipart/form-data" autocomplete="off">
		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<?php $hammer->writeTab("Details",1); ?>
				<?php if($action!="new"){?><?php $hammer->writeTab("Comments"); ?><?php } ?>
				<?php if($action!="new"){?><?php $hammer->writeTab("Audit"); ?><?php } ?>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php $hammer->writeTabHeader("details",1); ?>
				<br />
					<table class="table table-hover">
						<tr><td>
						<div class="form-group form-group-lg">
							<label for="<?php echo $hr->page;?>-timeline">Timeline</label>
							<input type="hidden" name="timeline" value="" />
							<select id="<?php echo $hr->page;?>-timeline" name="timeline" class="form-control lz-field">
								<?php
								foreach($tl->q("","ORDER BY `name`") as $row)
								{
									echo "<option value=\"" . $row['id'] . "\""; if($hr->row['timeline']==$row['id']){echo " selected";} echo ">" . $row['name'] ."</option>";
								}
								?>
								</select>
							</div>
						</td></tr>
						<tr><td>
							<?php if(!$hr->row['timestamp']){
								$hr->row['timestamp']=$hammer->getHT('sqlts');
							}else{
								// $time = $hammer->u2l($hr->row['timestamp']);
								// $hr->row['timestamp'] = $time->format('Y-m-d H:i:s');
							}
							$hr->dateTimePicker("timestamp","Timestamp");?></td></tr>
						<tr><td><?php $hr->textinput("title","Title");?></td></tr>
						
						<tr><td><?php $opt['classes']="";$hr->textarea("data","Data (Markdown)",$opt);?></td></tr>
						<script>
						var simplemde = new SimpleMDE({ element: document.getElementById("timeline-events-data-field") });
						</script> 
					</table>
				<?php $hammer->writeTabFooter(); ?>
				<?php $hammer->writeTabHeader("comments"); ?><br /><?php include "comments.php"; ?><?php $hammer->writeTabFooter(); ?>
				<?php $hammer->writeTabHeader("audit"); ?><br /><?php include "audit.php"; ?><?php $hammer->writeTabFooter(); ?>
			</div>
		</div>
		<br />
		<input type="hidden" name="id" value="<?php echo $hr->id; ?>">
		<div class="text-center">
		<div class="btn-group btn-group-lg">
			<?php echo $hr->saveButton(); ?><?php echo $hr->saveCloseButton();?>
		  <?php echo $hr->deleteButton($hr->row['id'],$hr->row['name']); ?>
		</div>
		</div>
		</form>
		<script><?php $hr->deleteHandler();?></script>
		<?php
	break;
	
	case "export":
		$hr->export("hammer-opportunities");
	break;
	
	default:
		$hr->getPageJS();
		
		?>
		
		<div class="row">
			<div class="col-md-12 text-center"><?php //$hr->filterBox(); ?></div>
		</div>
		<br />
		<?php
		
				
		echo "<div role=\"tabpanel\">
			<ul class=\"nav nav-tabs\" role=\"tablist\">";
		$hammer->writeTab("All",1);
		
		echo "</ul>";
		echo "<div class=\"tab-content\">";
		$hammer->writeTabHeader("All",1);

		
		$hr->listIndexWrapper("","ORDER BY timestamp DESC",1,"50","",$hammer->getHD());
		$hammer->writeTabFooter();

		echo "</div>";
		echo "</div>";
		 
} ?>

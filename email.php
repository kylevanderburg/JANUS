<?php
/*
NoteForge Hammer
by Kyle Vanderburg, in Poplar Bluff and Springfield, Missouri, and Norman, OK.
Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
All code copyright Kyle Vanderburg

This code is a module that requires the Hammer Core in order to fully work.
*/
// $hammer->debug();
$hr = new people_email($hammer);
$hr->restrict();
$action=$hammer->location['action'];

echo "<div class=\"hh\"><h1>People &raquo; Emails</h1></div>";
$action = $hammer->location[1];
switch ($action){
	case "new":
	case "insert":
	case "modify":
	case "write":
		if(($action==="insert") xor ($action==="write")){
			if($action==="insert"){$hr->create();}
			if(!isset($hr->id)){$hr->id=$_POST['id'];}
			$hr->update($_POST);
		}

		if($action=="modify"){$hr->id=$_GET['item'];}
		if($action=="insert"||$action=="modify"||$action=="write"){
			$hr->get();
		}
		$hr->saveCloseHandler($_POST);
		$hr->savedAlert($action); ?>
		<form name="<?php echo $hr->page; ?>" action="//vanderburg.app<?php echo $hammer->getHD(); ?>/<?php echo $hr->page; ?>/<?php if($action=="new"){echo "insert";}elseif(($action=="modify")||($action=="insert")||($action=="write")){echo "write";} ?>/" method="post" enctype="multipart/form-data">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<?php $hammer->writeTab("Details",1);?>
					<?php if($action!="new"){?><?php $hammer->writeTab("Comments");?><?php } ?>
					<?php if($action!="new"){?><?php $hammer->writeTab("Audit");?><?php } ?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<?php $hammer->writeTabHeader("Details",1);?>
					<br />

						<table class="table">
							<tr><td><?php $hr->textinput("fromname","From Name");?></td></tr>
							<tr><td><?php $hr->textinput("fromemail","From Email");?></td></tr>
							<tr><td><?php $hr->textinput("toname","To Name");?></td></tr>
							<tr><td><?php $hr->textinput("toemail","To Email");?></td></tr>
							<tr><td><?php $hr->textinput("subject","Subject");?></td></tr>
							<tr><td><?php $hr->textinput("date","Date Sent");?></td></tr>
							<tr><td><?php unset($options); $options['dr']="readonly";$hr->textinput("messid","Message ID",$options);?></td></tr>
							<tr><td><?php $opt['classes']="content-wys";$hr->textarea("body","Message",$opt);?></td></tr>
							<tr><td><?php unset($options);$options['dr']="readonly";$options['clip']=1;$hr->textinput("guid","Message GUID",$options);?></td></tr>
							<tr><td>https://public.vanderburg.app/email/<?php echo $hr->row['guid'];?>/</td></tr>
						</table>
					<?php $hammer->writeTabFooter();?>
					<?php $hammer->writeTabHeader("Comments");?>
						<br />
						<?php include "comments.php"; ?>
					<?php $hammer->writeTabFooter();?>
					<?php $hammer->writeTabHeader("Audit");?>
						<br />
						<?php include "audit.php"; ?>
					<?php $hammer->writeTabFooter();?>

				</div>
			<br />
			<input type="hidden" name="id" value="<?php echo $hr->id; ?>">
			<div class="text-center">
			<div class="btn-group btn-group-lg">
				<?php echo $hr->saveButton();?><?php echo $hr->deleteButton($hr->id,$hr->row['url']); ?>

			</div>
			</div>
		</form>
		<?php
	break;
	
	default:	
		$hr->getPageJS();
		?>
		<div class="row">
				<div class="col-md-6 text-center">
				<a href="/<?php echo $hammer->getHD(); ?>/<?php echo $hr->page; ?>/new/" class="btn btn-liszt"><i class="fass fa-plus"></i></a>
				</div>
				<div class="col-md-6 text-center">
				<form method="post" action="/<?php echo $hr->page; ?>/search/" name="search">
				<div class="input-group">
				<input type="text" class="form-control" name="query" placeholder="Query">
				<div class="input-group-append">
				<a href="javascript: document.search.submit();" class="btn btn-liszt"><i class="fa fa-search"></i></a></div>
				</div>
				</form>
				</div>
			</div>
		<br />
		<?php
		echo "<table class=\"table table-hover table-sm\">";
		foreach($hr->q("","ORDER BY date") as $row)
		{
		echo "<tr class=\"lz-row\"><td><a href='//janus.vanderburg.app" . $hammer->getHD() . "/" . $hr->page . "/modify/" . $row['id'] . "/'>".$row['subject']."</a>  <button class=\"btn btn-warning btn-sm lz-delete-row pull-right\" data-friendly=\"" . $hammer->unsanitize($row['name']) . "\" id=\"" . $row['id'] . "\"><i class=\"fa fa-trash\"></i></button></td></tr>";
		}

		echo "</table>";
	break;
}	?>
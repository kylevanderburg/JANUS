	<ul class="list-unstyled ps-0">
		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false"><i class="nav-icon fa-light fa-user-circle fa-fw"></i><span class="ms-2"><?php echo $hammer->user['firstname']." ".$hammer->user['lastname'];?></span></button>
			<div class="collapse" id="user-collapse">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
					<li><a href="/<?php echo $key;?>/groups/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="groups")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","groups");?> fa-fw nav-icon"></i> Impersonate</a></li>
					<li><a href="/<?php echo $key;?>/achievements/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="achievements")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","achievements");?> fa-fw nav-icon"></i> Profile</a></li>
					<li><a href="/<?php echo $key;?>/juries/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="juries")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","juries");?> fa-fw nav-icon"></i> Sign Out</a></li>
				</ul>
			</div>
		</li>

		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#sites-collapse" aria-expanded="false"><i class="nav-icon fa-light fa-city"></i><span class="ms-2"><?php echo strtoupper($hammer->getSiteVar('sitetitle'));?></span></button>
			<div class="collapse" id="sites-collapse">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
					<?php
						foreach($hammer->sites as $k=>$v){
							if($hammer->getHS('short')==$k){$class=" active";}else{$class="";}
							echo "<li class=\"lz-siteitem\"><a href=\"/".$k."/".$hammer->location['platform']."/".$herepage."\" class=\"nav-link".$class."\"><i class=\"fa-light fa-city nnavav-icon\"></i><span class=\"ms-2\">".strtoupper($v)."</span></a></li>";
						}
					?>
				</ul>
			</div>
		</li>
	</ul>

	<ul class="list-unstyled ps-0">
			<li class="mb-1">
				<a class="btn btn-notoggle d-inline-flex align-items-center border-0<?php if($hammer->getHD()==$hammer->getHS('short')."/dashboard"){echo " active";}?>" href="/<?php echo $key;?>/dashboard/"><i class="nav-icon <?php echo $hammer->moduleIcon("dashboard");?> fa-fw"></i><span class="ms-2">Dashboard</span></a>
			</li>

		<li class="border-top my-3"></li>

		<?php $key = $hammer->getHS('short')."/hammer"; if($hammer->isModuleActive("hammer")){ ?>
			<li class="mb-1">
				<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#hammer-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("hammer");?> fa-fw"></i><span class="ms-2">Hammer</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/hammer"){echo " show";}?>" id="hammer-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					<li><a href="/<?php echo $key;?>/compositions/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="compositions")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","compositions");?> fa-fw nav-icon"></i> Music</a></li>
					<li><a href="/<?php echo $key;?>/opportunities/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="opportunities")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","opportunities");?> fa-fw nav-icon"></i> Opportunities</a></li>
					<li><a href="/<?php echo $key;?>/content/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="content")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","content");?> fa-fw nav-icon"></i> Web Pages</a></li>
					<li><a href="/<?php echo $key;?>/projects/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="projects")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","projects");?> fa-fw nav-icon"></i> Projects</a></li>
					<li><a href="/<?php echo $key;?>/workorders/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="workorders")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","workorders");?> fa-fw nav-icon"></i> Work Orders</a></li>
					<li><a href="/<?php echo $key;?>/mailing-lists/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="mailing-lists")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","mailing-lists");?> fa-fw nav-icon"></i> Mailing Lists</a></li>
					<li><a href="/<?php echo $key;?>/royalty-reports/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="royalty-reports")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","royalty-reports");?> fa-fw nav-icon"></i> Royalty Reports</a></li>
					<li><a href="/<?php echo $key;?>/deliveries/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="deliveries")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","deliveries");?> fa-fw nav-icon"></i> Deliveries</a></li>
					<!--<li><a href="/<?php echo $key;?>/site-time/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="site-time")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("hammer","time");?> fa-fw nav-icon"></i>Time-Sites</a></li>-->
					</ul>
				</div>
			</li>
		<?php } ?>

		<?php $key = $hammer->getHS('short')."/apps"; if($hammer->isModuleActive("apps")){ ?>
			<li class="mb-1">
				<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0" data-bs-toggle="collapse" data-bs-target="#apps-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("apps");?> fa-fw"></i><span class="ms-2">Liszt Apps</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/apps"){echo " show";}?>" id="apps-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
						<li><a href="/<?php echo $key;?>/audioatlas/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="audioatlas")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("apps","audioatlas");?> fa-fw nav-icon"></i> AudioAtlas</a></li>
						<li><a href="/<?php echo $key;?>/ragingred-entry/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="ragingred-entry")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("apps","ragingred-entry");?> fa-fw nav-icon"></i> Raging Red</a></li>
						<li><a href="/<?php echo $key;?>/scoreshare/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="scoreshare")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("apps","scoreshare");?> fa-fw nav-icon"></i> ScoreShare</a></li>
					</ul>
				</div>
			</li>	
		<?php } ?>

		<?php $key = $hammer->getHS('short')."/people"; if($hammer->isModuleActive("people")){ ?>
			<li class="mb-1">
				<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#people-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("people");?> fa-fw"></i><span class="ms-2">People</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/people"){echo " show";}?>" id="people-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
						<li><a href="/<?php echo $key;?>/people/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="people")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","people");?> fa-fw nav-icon"></i> People</a></li>
						<li><a href="/<?php echo $key;?>/groups/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="groups")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","groups");?> fa-fw nav-icon"></i> Groups</a></li>
						<li><a href="/<?php echo $key;?>/achievements/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="achievements")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","achievements");?> fa-fw nav-icon"></i> Achievements</a></li>
						<li><a href="/<?php echo $key;?>/juries/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="juries")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("people","juries");?> fa-fw nav-icon"></i> Juries</a></li>
					</ul>
				</div>
			</li>
		<?php } ?>


		<?php $key = $hammer->getHS('short')."/david"; if($hammer->isModuleActive("david")){ ?>
			<li class="mb-1">
				<a class="btn d-inline-flex btn-notoggle align-items-center border-0" href="/<?php echo $key;?>/documents/"><i class="nav-icon <?php echo $hammer->moduleIcon("david");?> fa-fw"></i><span class="ms-2">Documents</span></a>
			</li>
		<?php } ?>
				
		<?php $key = $hammer->getHS('short')."/schedule"; if($hammer->isModuleActive("schedule")){ ?>
			<li class="mb-1">
				<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#schedule-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("schedule");?> fa-fw"></i><span class="ms-2">Schedule</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/schedule"){echo " show";}?>" id="schedule-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
				
						<li><a href="/<?php echo $key;?>/events/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="events")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("schedule","events");?> fa-fw nav-icon"></i> Events</a></li>
						<li><a href="/<?php echo $key;?>/attendance/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="attendance")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("schedule","attendance");?> fa-fw  nav-icon"></i> Attendance</a></li>
					</ul>
				</div>
			</li>
		<?php } ?>
				
		<?php $key = $hammer->getHS('short')."/business"; if($hammer->isModuleActive("business")){ ?>
			<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#business-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("business");?> fa-fw"></i><span class="ms-2">Business</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/business"){echo " show";}?>" id="business-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
						<li><a href="/<?php echo $key;?>/expenses/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="expenses")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","expenses");?> fa-fw nav-icon"></i> Expenses</a></li>
						<li><a href="/<?php echo $key;?>/invoice/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="invoice")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","invoice");?> fa-fw nav-icon"></i> Invoices</a></li>
						<li><a href="/<?php echo $key;?>/products/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="products")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","products");?> fa-fw nav-icon"></i> Products</a></li>
						<li><a href="/<?php echo $key;?>/charges/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="charges")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","charges");?> fa-fw nav-icon"></i> Charges</a></li>
						<li><a href="/<?php echo $key;?>/payments/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="payments")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","payments");?> fa-fw nav-icon"></i> Payments</a></li>
						<li><a href="/<?php echo $key;?>/carts/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="carts")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("business","carts");?> fa-fw nav-icon"></i> Carts</a></li>
					</ul>
				</div>
			</li>
		<?php } ?>

		<?php $key = $hammer->getHS('short')."/inventory"; if($hammer->isModuleActive("inventory")){ ?>
			<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center border-0" data-bs-toggle="collapse" data-bs-target="#inventory-collapse" aria-expanded="false"><i class="nav-icon <?php echo $hammer->moduleIcon("inventory");?> fa-fw"></i><span class="ms-2">Inventory</span></button>
				<div class="collapse<?php if($hammer->getHD()==$hammer->getHS('short')."/inventory"){echo " show";}?>" id="inventory-collapse">
					<ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
						<li><a href="/<?php echo $key;?>/equipment/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="equipment")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","equipment");?> fa-fw nav-icon"></i> Equipment</a></li>
						<li><a href="/<?php echo $key;?>/keys/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="keys")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","keys");?> fa-fw nav-icon"></i> Keys</a></li>
						<li><a href="/<?php echo $key;?>/lockers/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="lockers")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","lockers");?> fa-fw nav-icon"></i> Lockers</a></li>
						<li><a href="/<?php echo $key;?>/instruments/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="instruments")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","instruments");?> fa-fw nav-icon"></i> Instruments</a></li>
						<li><a href="/<?php echo $key;?>/music/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="music")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","music");?> fa-fw nav-icon"></i> Music</a></li>
						<li><a href="/<?php echo $key;?>/uniforms/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="uniforms")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","uniforms");?> fa-fw nav-icon"></i> Uniforms</a></li>
						<li><a href="/<?php echo $key;?>/checkouts/" class="nav-link<?php if($hammer->getHD()==$key && ($page=="checkouts")){echo " active";}?>"><i class="<?php echo $hammer->pageIcon("inventory","checkouts");?> fa-fw nav-icon"></i> Checkouts</a></li>
					</ul>
				</div>
			</li>
		<?php } ?>

		<li class="border-top my-3"></li>

		<li class="mb-1">
			<a class="btn btn-notoggle d-inline-flex align-items-center border-0" href="/<?php echo $key;?>/reports/"><i class="nav-icon <?php echo $hammer->moduleIcon("reports");?> fa-fw"></i><span class="ms-2">Reports</span></a>
		</li>

		<li class="mb-1">
			<a class="btn btn-notoggle d-inline-flex align-items-center border-0" href="/<?php echo $key;?>/tools/"><i class="nav-icon <?php echo $hammer->moduleIcon("tools");?> fa-fw"></i><span class="ms-2">Tools</span></a>
		</li>

		<li class="mb-1">
			<?php if($hammer->isModuleActive("settings") && $hammer->getUserRole()>6){ ?><a class="btn btn-notoggle d-inline-flex align-items-center border-0" href="/<?php echo $key;?>/settings/"><i class="nav-icon <?php echo $hammer->moduleIcon("settings");?> fa-fw"></i><span class="ms-2">Settings</span></a><?php } ?>
		</li>

		<li class="mb-1">
			<a class="btn btn-notoggle d-inline-flex align-items-center border-0" href="/<?php echo $key;?>/support/"><i class="nav-icon <?php echo $hammer->moduleIcon("help");?> fa-fw"></i><span class="ms-2">Support</span></a>
		</li>

		
	</ul>
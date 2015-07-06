				<?php 
				$this->load->library('session');
				$udata = $this->session->all_userdata();
				$uid = $udata['user_id'];
				$utype = $udata['type'];
				if($page == 'content' && $_GET['type'] == 'calls'){$page = 'contentcall';}
				if($page == 'content' && $_GET['type'] == 'sms'){$page = 'contentsms';}
				?>
				<nav id="nav" >
						<ul>
							<li class="mainli topborder <?php if($page == "dashboard"){echo 'active';}else{} ?>" >
								<a href="<?php echo site_url("indexpage/dashboard");?>"><i class="dash-ico" ></i><?php echo $dash_title;?></a>
							</li>
							
							<li class="mainli" ><a><i class="call-ico" ></i><?php echo $calls;?></a></li>
								<div class="nav-submenu" >
									<ul>
										<li class="<?php if($page == "callsteps"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("phonecall/step1");?>">
										<?php if($page == "callsteps"){echo '<i class="placecall-ico-w" ></i>';}else{echo '<i class="placecall-ico" ></i>';};?>
										<?php echo $callschedule_title;?></a></li>
										<li class="<?php if($page == "callhistory"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("phonecall/history");?>">
										<?php if($page == "callhistory"){echo '<i class="history-ico-w" ></i>';}else{echo '<i class="history-ico" ></i>';};?>
										<?php echo $call_history;?></a></li>
									</ul>
								</div>
							
							<li class="mainli" ><a><i class="sms-ico" ></i><?php echo $sms;?></a></li>
								<div class="nav-submenu" >
									<ul>
										<li class="<?php if($page == "smssteps"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("sms/step1");?>">
										<?php if($page == "smssteps"){echo '<i class="sendsms-ico-w" ></i>';}else{echo '<i class="sendsms-ico" ></i>';};?>
										<?php echo $send_sms;?></a></li>
										<li class="<?php if($page == "smshistory"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("sms/history");?>">
										<?php if($page == "smshistory"){echo '<i class="history-ico-w" ></i>';}else{echo '<i class="history-ico" ></i>';};?>
										<?php echo $sms_history;?></a></li>
									</ul>
								</div>
							<li class="mainli" ><a><i class="content-ico" ></i><?php echo $master_content;?></a></li>
								<div class="nav-submenu" >
									<ul>
										<li class="<?php if($page == "contentcall"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("content/content_home");?>?type=calls">
										<?php if($page == "contentcall"){echo '<i class="voicecont-ico-w" ></i>';}else{echo '<i class="voicecont-ico" ></i>';};?>
										<?php echo $voice_label;?></a></li>
										<li class="<?php if($page == "contentsms"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("content/content_home");?>?type=sms">
										<?php if($page == "contentsms"){echo '<i class="sendsms-ico-w" ></i>';}else{echo '<i class="sendsms-ico" ></i>';};?>
										<?php echo $sms_text;?></a></li>
									</ul>
								</div>
							<li class="mainli" ><a><i class="member-ico" ></i><?php echo $member_manage;?></a></li>
								<div class="nav-submenu" >
									<ul>
										<li class="<?php if($page == "member"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("member/index");?>">
										<?php if($page == "member"){echo '<i class="adduser-ico-w" ></i>';}else{echo '<i class="adduser-ico" ></i>';};?>
										<?php echo $member_manage;?></a></li>
										<li  class="<?php if($page == "category"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("member/category");?>">
										<?php if($page == "category"){echo '<i class="addgroups-ico-w" ></i>';}else{echo '<i class="addgroups-ico" ></i>';};?>
										<?php echo $group_menu;?></a></li>
									</ul>
								</div>
								
							<li class="mainli" ><a><i class="user-ico" ></i><?php echo $user_management;?></a></li>
								<div class="nav-submenu" >
									<ul>
										<li class="<?php if($page == "profile"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("user/profile");?>">
										<?php if($page == "profile"){echo '<i class="edituser-ico-w" ></i>';}else{echo '<i class="edituser-ico" ></i>';};?>
										<?php echo $edit_profile;?></a></li>
										<li class="<?php if($page == "changepassword"){echo 'activein';}else{}?>" ><a href="<?php echo site_url("user/changepwd");?>">
										<?php if($page == "changepassword"){echo '<i class="changepwd-ico-w" ></i>';}else{echo '<i class="changepwd-ico" ></i>';};?>
										<?php echo $changepwd_menu;?></a></li>
									</ul>
								</div>
							<li class="mainli" ><a href="<?php echo site_url("indexpage/logout");?>"><i class="logout-ico" ></i><?php echo $logout;?></a></li>
							<li class="bottom_li" ></li>
						</ul>
					</nav>
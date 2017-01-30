<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
								$profile = $this->session->userdata['profile_pic'];
								if(empty($profile)) {
									$profile = 'avatar5.png';
								}
                            ?>
                            <img src="<?php echo base_url('assets/users/'.$profile)?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->session->userdata['username'];?></p>
							<?php
								if(isset($this->session->userdata['company_name'])) {
									echo "<strong>".$this->session->userdata['company_name']."</strong>";
								}
							?>
                            <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <form action="<?php echo base_url();?>user/search" method="post" class="sidebar-form">
                        <div class="input-group">
                        <?php
                        $q = $this->input->post('q');
                        ?>
                            <input type="text" name="q" value="<?php echo $q;?>" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_url();?>user/switch_company">
                                <i class="fa fa-dashboard"></i> <span>Company Master</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>">
                                <i class="fa fa-envelope"></i> <span>Members</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>/subscriber">
                                <i class="fa fa-envelope"></i> <span>Subscribers</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>advertisement">
                                <i class="fa fa-calendar"></i> <span>Advertisement</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>subscription_details">
                                <i class="fa fa-calendar"></i> <span>Subscription Charges</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>advertisement_details">
                                <i class="fa fa-calendar"></i> <span>Adverstisement Charges</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>invoice">
                                <i class="fa fa-calendar"></i> <span>Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>">
                                <i class="fa fa-calendar"></i> <span>Reports</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

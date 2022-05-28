                        	<?php if($page_active!='login' && $page_active!='activity'){ ?>
								<?php include(APPPATH.'views/logics/recent_activity.php'); ?>
                                <?php if(!empty($ra_indicator) && !empty($ra_item)){ ?>
                                    <div class="panel">
                                        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                            <ol class="carousel-indicators">
                                                <?php if(!empty($ra_indicator)){echo $ra_indicator;} ?>
                                            </ol>
        
                                            <div class="carousel-inner">
                                                <?php if(!empty($ra_item)){echo $ra_item;} ?>
                                            </div>
          
                                            <a data-slide="prev" href="#quote-carousel" class="left carousel-control">
                                                <i class="ti-arrow-circle-left"></i>
                                            </a>
                                            <a data-slide="next" href="#quote-carousel" class="right carousel-control">
                                                <i class="ti-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            
                            <?php if($page_active!='login'){ ?>
                                <h4 class="text-muted">Trending</h4>
                                <?php include(APPPATH.'views/logics/trending.php'); ?>
                                <?php if(!empty($trending)){echo $trending;} ?>
                            <?php } ?>
                            
                            <?php if($page_active!='login'){ ?>
                                <h4 class="text-muted">Today's Matches</h4>
                                <?php include(APPPATH.'views/logics/fixtures.php'); ?>
                                <?php if(!empty($fix_list)){echo $fix_list;} ?>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <footer class="row" style="border-top:1px solid #6CC;">
                        <div class="text-center">
                            <div class="col-sm-12 mb25">
                                <!--<br />
                                <a class="btn btn-primary btn-social-icon btn-rounded btn-outline btn-sm smooth-scroll mb25" href="#top"><i class="ti-angle-up"></i></a>-->
                                <br />
                                <a class="btn btn-social-icon btn-facebook btn-rounded btn-sm ml5 mr5" href="https://facebook.com/soccerfanhub" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="btn btn-social-icon btn-twitter btn-rounded btn-sm ml5 mr5" href="https://twitter.com/soccerfanhub" target="_blank"><i class="fa fa-twitter"></i></a>
                            </div>
                            
                            <div class="col-sm-12 mb25">
                                <p>Made with&nbsp;<i class="ti-heart text-success"></i>&nbsp;in Nigeria</p>
                                <a data-toggle="modal" href="#model_tos">Terms of Services</a><br /><br />
                                <small class="show">Copyright&nbsp;&copy;&nbsp;<?php echo date('Y'); ?>, SFH - SoccerFanHub.&nbsp;All rights reserved<br /><small class="text-muted">31, Wina-Ofure Shopping Mall, Odogunyan Ikorodu, Lagos, Nigeria<br/><b>Supports:</b><a href="mailto:info@soccerfanhub.com">info@soccerfanhub.com</a></small></small></small>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- /inner content wrapper -->
            </div>
            <!-- /content wrapper -->
            <a class="exit-offscreen"></a>
        </section>
        <!-- /main content -->
    </section>
    
    <div id="model_tos" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
              <h4 class="modal-title" id="myModalLabel">Terms and Conditions of Services</h4>
            </div>
            <div class="modal-body">
           		To ensure Members rights protection, we have created and embraced some collections of legal agreements for effective protection.
                <h4>Terms and Conditions of Services:</h4>
                The agreements that bounds all Members are in this Terms and Conditions of Services which you are presently reading, which indicated all legal terms for using this platform, by which you fully bought by registering on this website. This Terms and Conditions of Services might be updated anytime on successful reviewed with or without your notice, but we will definitely notify you once an update takes place.
                <h4>Description and Use of Services:</h4>
                SoccerFanHub as a Soccer Club Fans Network which provide members with variety of resources to get engaged with Clubs activity such as Moots (Debates), Club Facts Update, etc.<br /><br />
                This portal is a free for all Soccer Lovers. To keep this portal free, we need to impose these legal terms on all members to make them to be conscious about activities engagement.
                <h4>General Rule:</h4>
                To bypass unnecessary inconveniences to our Contributors or to SoccerFanHub as a whole, the general rule is that you must not copy, distribute, transmit, publish, reproduce, license, transfer, or sell against any legal right bounded to any resources on this site by our Contributors or Third Parties. Most resources are merely meant for your personal and non-commercial use or otherwise, except been strictly permitted by SoccerFanHub or Permitted Contributors/Third Parties.
                <h4>General Contributor Rule:</h4>
                To protect all Members of this site, Contributors of this site must not publish any sort of resources without full patent right of either ownership or distributor.
                <h4>Contribution to Multimedia Contents:</h4>
                For patent right violation eradication, you must not publish any Multimedia Contents (Texts, Images, Audios, Videos) on this site without obtaining proper patent right of ownership or distributorship. SoccerFanHub will not be responsible for any illegal Multimedia Contents you publish on this site.<br /><br />
                If any action of such is detected, we will be left with no other choice than to direct applicable penalties to the distributor of such Multimedia Content(s) without notification.<br /><br />
                All Multimedia Contents been contributed to this site will have automatic download or use right. So once you agree that all Members of this site can download or use your Multimedia Content(s) you can contribute to our Multimedia Contents.
                <h4>Rights and Obligation:</h4>
                SoccerFanHub has the right to review, edit, delete or modify any Multimedia Contents you provide to us through the platform, and to publish, reject, remove or block access to any Multimedia Content, for any reason whatsoever, at any time. The submission of content in no way creates any obligation or duty on the part of SoccerFanHub to post or use such content.<br /><br />
                To give us capacity to act without repercussion to protect against people we believed are abusing the Terms and Conditions of Services, SoccerFanHub reserves the right to terminate membership at any time, without notice, for any reason whatsoever.<br /><br />
                All Contributors acknowledge that he/she may receive positive or negative comments on a posted Multimedia Contents or resources, and that there is a chance that those comments may significantly harm the Contributor's professional reputation. You release, indemnify and hold harmless SoccerFanHub, its affiliates, employees, contractors, agents, and assigns from all liability for loss or damage howsoever occasioned resulting from any such comments. Neither SoccerFanHub nor its suppliers will be liable for any of those types of damages known as direct, indirect, special, consequential, incidental, exemplary or punitive related to such comments, to the maximum extent the law permits, no matter what legal theory it's based on.
                <h4>Limitation of Liability:</h4>
                You represent, warrant and covenant that no materials of any kind submitted through your membership will violate, plagiarize or infringe upon the rights of any third party, including copyright, trademark, privacy or other personal or proprietary rights or contain libellous or otherwise unlawful material. You hereby indemnify, defend and hold harmless SoccerFanHub and all our Contributors from and against any and all liability and costs, including without limitation, solicitors’ fees incurred by the Indemnified Parties in connection with any claim arising out of any breach by you or any user of membership account, of these terms and conditions or the foregoing representations, warranties and covenants. You shall cooperate as fully as reasonably required in the defence of any such claim. SoccerFanHub reserves the right, at its own expense, to assume the exclusive defence and control of any matter subject to indemnification by you.<br /><br />
                SOCCERFANHUB AND/OR ITS RESPECTIVE SUPPLIERS AND CONTRIBUTORS MAKE NO REPRESENTATIONS ABOUT THE SUITABILITY OF THE INFORMATION CONTAINED IN THE MULTIMEDIA CONTENTS PUBLISHED AS PART OF THE SERVICES FOR ANY PURPOSE. ALL CONTENTS IS PROVIDED "AS IS", "WHERE IS", "AS AVAILABLE", WITHOUT WARRANTY OF ANY KIND. SOCCERFANHUB AND/OR ITS RESPECTIVE SUPPLIERS HEREBY DISCLAIM ALL WARRANTIES AND CONDITIONS WITH REGARD TO ALL MULTIMEDIA CONTENTS, INCLUDING ALL WARRANTIES AND CONDITIONS OF MERCHANTABILITY, WHETHER EXPRESS, IMPLIED OR STATUTORY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT.<br /><br />
                THE MULTIMEDIA CONTENTS PUBLISHED ON THE SERVICES COULD INCLUDE TECHNICAL INACCURACIES OR TYPOGRAPHICAL ERRORS. CHANGES ARE PERIODICALLY ADDED TO THE INFORMATION HEREIN. SOCCERFANHUB AND/OR ITS RESPECTIVE SUPPLIERS MAY MAKE IMPROVEMENTS AND/OR CHANGES IN THE PRODUCT(S) AND/OR THE PROGRAM(S) DESCRIBED HEREIN AT ANY TIME.
                <h4>Third Party Links:</h4>
                As an Entertainment Hub, SoccerFanHub does not endorse the owners of, or the contents, products or services on any third-party websites. Linked sites are not under the control SoccerFanHub and SoccerFanHub is not responsible for the contents of linked third-party sites, indexes or directories, sites framed within this site, or third-party advertisements, or any changes or updates to such sites. SoccerFanHub is not responsible for any form of transmission received from any linked site, and SoccerFanHub does not make any representations regarding their content, accuracy or non-infringement. Your use of third-party websites is at your own risk and subject to the terms of use for such sites. You should be aware that both the terms of use and the privacy policies of linked sites may differ from those of SoccerFanHub, so you are subject to carefully review them.
                <h4>Property Infringement:</h4>
                You agree that you will not upload or distribute any communications or content of any type that infringe or violate any rights of any party. It is the policy of SoccerFanHub not to permit materials known by SoccerFanHub to be infringing to remain on the Platform. You should notify SoccerFanHub promptly if you believe any materials on the site, including advertisements, or Multimedia Contents available on or through links, frames, indexes and directories linked to this site, infringe a third party copyright. Upon SoccerFanHub receiving a proper notice of claimed infringement under the Digital Millennium Copyright Act and applicable laws of other jurisdictions (collectively the "DMCA"), SoccerFanHub will respond expeditiously to remove, or disable access to, the material claimed to be infringing and will follow the procedures specified in the DMCA to resolve the claim between the notifying party and the alleged infringer who provided the content at issue.<br /><br />
                Please contact SoccerFanHub representative listed at the bottom of this section for copyright infringement notices only. If you have a question about your account on SoccerFanHub, a general question, or any other Customer Service inquiry, please <b><a href="mailto:info@soccerfanhub.com">info@soccerfanhub.com</a></b>, or call us <b>+234 805 891 7364</b>.
                <h4>Governing Law and Jurisdiction:</h4>
                This agreement shall be governed by and construed in accordance with the laws of Nigeria. The Nigerian courts shall have exclusive jurisdiction and venue over any dispute arising out of or relating to the agreement and each party hereby consent to the jurisdiction and venue of such courts.<br /><br />
                If any provision of the terms is found by a court of competent jurisdiction to be invalid, void, unlawful or unenforceable for any reason, that term shall be severed from this agreement and the remaining provisions shall remain in full force and effect; the parties nevertheless agree that the court shall endeavour to give effect to the parties’ intentions as reflected in the provision.
                <h4>Complaints</h4>
                For abuse or infringement notice, please send mail to <b><a href="mailto:complaint@soccerfanhub.com">complaint@soccerfanhub.com</a></b>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    
    <div id="model_verify" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i> Verify <?php if(!empty($clubname)){echo $clubname;} ?> Membership</h4>
            </div>
            <div class="modal-body">
           		To make your account Verified and let other Fans knows you are a Verified Fan of your Club, you must Insert Membership Code Received after your registration with Global Club.<br /><br />
                <b>PLEASE NOTE:</b> You must have registered with Global Club before this process. Thanks
                <h4><?php if(!empty($clubname)){echo $clubname;} ?> Membership Code:</h4>
                <input type="text" class="form-control" id="codevalue" />
                <div id="send_code_reply"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-sm btn-success" onclick="send_code();"><i class="fa fa-check"></i> Submit</button>
              
              <script type="text/javascript">
				  function send_code(){
					  var hr = new XMLHttpRequest();
					  var codevalue = document.getElementById('codevalue').value;
					  var c_vars = "codevalue="+codevalue;
					  hr.open("POST", "<?php echo base_url('settings/submit_code'); ?>", true);
					  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					  hr.onreadystatechange = function() {
						  if(hr.readyState == 4 && hr.status == 200) {
							  var return_data = hr.responseText;
							  document.getElementById("send_code_reply").innerHTML = return_data;
						 }
					  }
					  hr.send(c_vars);
					  document.getElementById("send_code_reply").innerHTML = "<i class=\"icon-spin4 animate-spin loader\"></i>";
				  }
			  </script>
            </div>
          </div>
        </div>
    </div>
    
    <!-- core scripts -->
    <script src="<?php echo base_url(); ?>plugins/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/appear/jquery.appear.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.placeholder.js"></script>
    <script src="<?php echo base_url(); ?>plugins/fastclick.js"></script>
    <!-- /core scripts -->

    <!-- page level scripts -->
    <script src="<?php echo base_url(); ?>plugins/jquery.blockUI.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.sparkline.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>plugins/count-to/jquery.countTo.js"></script>
    <!-- /page level scripts -->
    
    <!-- page level scripts -->
    <script src="<?php echo base_url(); ?>plugins/isotope/isotope.pkgd.min.js"></script>
    <!-- /page level scripts -->

    <!-- page script -->
    <!--<script src="<?php echo base_url(); ?>js/dashboard.js"></script>-->
    <!-- /page script -->
    
    <!-- page level scripts -->
    <script src="<?php echo base_url(); ?>plugins/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
    <!-- /page level scripts -->
    
    <!-- page level scripts -->
    <script src="<?php echo base_url(); ?>plugins/wysiwyg/bootstrap-wysiwyg.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <!-- /page level scripts -->
    
    <!-- page script -->
	<script src="<?php echo base_url(); ?>js/bootstrap-datatables.js"></script>
    <script src="<?php echo base_url(); ?>js/datatables.js"></script>
    <!-- /page script -->
    
    <!-- page script -->
	<script src="<?php echo base_url(); ?>plugins/stepy/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/stepy/jquery.stepy.js"></script>
    <script src="<?php echo base_url(); ?>plugins/fuelux/wizard.js"></script>
	<script src="<?php echo base_url(); ?>js/form-wizard.js"></script>
    <!-- /page script -->
    
    <!-- page script -->
    <script src="<?php echo base_url(); ?>plugins/daterangepicker/moment.js"></script>
    <script src="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>plugins/timepicker/jquery.timepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-colorpalette/bootstrap-colorpalette.js"></script>
	<script src="<?php echo base_url(); ?>js/pickers.js"></script>
    <script src="<?php echo base_url(); ?>js/validate.js"></script>
    
    <?php if($page_active=='wallet'){ ?>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.sparkline.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/easy-pie-chart/jquery.easypiechart.js"></script>
    <script src="<?php echo base_url(); ?>plugins/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/morris/morris.js"></script>
    <script src="<?php echo base_url(); ?>plugins/chartjs/Chart.min.js"></script>
    <?php } ?>
    
    <script src="<?php echo base_url(); ?>js/general.js"></script>
    
    <!-- page script -->
    <script src="<?php echo base_url(); ?>js/catalog.js"></script>
    
    <!-- template scripts -->
    <script src="<?php echo base_url(); ?>js/offscreen.js"></script>
    <script src="<?php echo base_url(); ?>js/main.js"></script>
    <!-- /template scripts -->
    
    <?php if($page_active=='wallet'){ ?>
    <script src="<?php echo base_url(); ?>js/chart.js"></script>
    <?php } ?>
    
    <!-- scripts -->
	<script type="text/javascript">
        $(document).ready(function() {
			$('#sfhtblist').dataTable();
		} );
    </script>
    
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54f059895825b165" async="async"></script>
</body>
<!-- /body -->
</html>
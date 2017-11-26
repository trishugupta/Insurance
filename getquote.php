<?php
 include('header.php');
 
 ?>

<div class="container">
	<?php 
  include( "db.php" );
  ?>
	<h3 class="page-header">Get a Quote</h3>
 <script>
				$(document).ready(function () {
					//$('select').material_select();
					if($("#i1")[0].checked){
						$("#life").css("display", "block");
						$("#home").css("display", "none");
						$("#auto").css("display", "none");
					}
					else if($("#i2")[0].checked){
						$("#life").css("display", "none");
						$("#home").css("display", "block");
						$("#auto").css("display", "none");
					}
					else if($("#i3")[0].checked){
						$("#life").css("display", "none");
						$("#home").css("display", "none");
						$("#auto").css("display", "block");
					}
					
					$("#i1").click(function () {
						$("#life").css("display", "block");
						$("#home").css("display", "none");
						$("#auto").css("display", "none");
					});
					$("#i2").click(function () {
						$("#life").css("display", "none");
						$("#home").css("display", "block");
						$("#auto").css("display", "none");
					});
					$("#i3").click(function () {
						$("#life").css("display", "none");
						$("#home").css("display", "none");
						$("#auto").css("display", "block");
					});
					if($('#hiperson').val() == 'Self')
						{
							$('#family').hide();
							$('#kids').hide();
						}
						else if($('#hiperson').val() == 'Family')
						{
							$('#family').show();
							$('#kids').show();
						}
					$('#hiperson').change(function() {
						if($('#hiperson').val() == 'Self')
						{
							$('#family').hide();
							$('#kids').hide();
						}
						else if($('#hiperson').val() == 'Family')
						{
							$('#family').show();
							$('#kids').show();
						}
					});
					$('#imanufacturer').change(function() {
						var manufacturer = $('#imanufacturer').val();
						$.ajax({
							type: "GET",
							url: "utility.php",
							data: "manufacturer=" + manufacturer,
							success: function(result) {
								$("#imodel").html("<option value='0' selected>Choose Model</option>"+result);
							}
						});
					});
					$("#validate_form").validate({
						invalidHandler: function(event, validator) {
						if (validator.numberOfInvalids() > 0) {
							validator.showErrors();
							// Open accordion tab with errors
							var index = $(".has-error")
								.closest(".ui-accordion-content")
								.index(".ui-accordion-content");
							$(".accordion").accordion("active", index);
						}
					},
					ignore: [],
					});
				});
				</script>
	<div class="main">
		<form id="validate_form" method="POST" name="quote" action="buypolicy.php" class="validate">

			<div>
				<h5 class="center">What do you want to Insure ?</h5>
				<br/>
				
				<div class="row center">
				
					<input class="with-gap" name="itype" value="homeinsurance" type="radio" id="i2" />
					<label for="i2" style="width:120px;text-align:left">Home</label>

					<input class="with-gap" name="itype" value="healthinsurance" type="radio" id="i1" />
					<label for="i1" style="width:120px;text-align:left;">Health</label>

					<input class="with-gap" name="itype" value="carinsurance" type="radio" id="i3"  />
					<label for="i3" style="width:120px;text-align:left">Car</label>
				</div>

				<ul id="life" class="collapsible" style="display:none" data-collapsible="accordion">
					<li>
						<!--style="display:none"-->
						<div class="collapsible-header">
							<!--<i class="material-icons">assessment</i>-->Insurance for</div>
						<div class="collapsible-body">
							<div class="row">
							<h5 class="col-md-6">I need a Health Insurance plan for</h5>
							<select id="hiperson" class="browser-default col-md-6" style="font-size:20px" name="hiperson">
									<option value="Self" selected>Self</option>
									<option value="Family">Family</option>
								</select>.
							</div>
						</div>
					</li>
					<li>
						<!--style="display:none"-->
						<div class="collapsible-header">
							<!--<i class="material-icons">assessment</i>-->Details of the insured</div>
						<div class="collapsible-body">
							<div id="self">
								<div class="row">
										<div class="input-field col s2">
										<label>Self : </label>
									</div>
									<div class=" col s5">
									<label for="hselfage">Date of Birth : </label>
										<input type="date" id="hselfage" name="hselfage" value="1965-12-31" min="1965-12-31" max="2010-12-31" class="validate"/>
									<p class="help-block"></p>
									</div>
									<div class=" col s5">
									<label for="hselfgender">Gender </label>
										<select id="hselfgender" name="hselfgender" class="browser-default">
										<option value="Male" selected>Male</option>
										<option value="Female">Female</option>
									</select>
									</div>
								</div>
								</div>
								<div id="family" style="display:none">
								<div class="row">
									<div class="input-field col s2">
										<label>Spouse : </label>
									</div>
									<div class="col s5">
									<label for="hspouseage">Date of Birth : </label>
										<input type="date" id="hspouseage" name="hspouseage" value="1965-12-31" min="1965-12-31" max="2010-12-31" />
									</div>
									<div class=" col s5">
									<label for="hspousegender">Gender </label>
										<select id="hspousegender" name="hspousegender" class="browser-default">
										<option value="Male">Male</option>
										<option value="Female" selected>Female</option>
									</select>
									</div>
								</div>
								</div>
								<div id="kids" style="display:none">
								<div class="row">
									<div class="input-field col s2">
										<label>kids : </label>
									</div>
									<div class="col s5">
									<label for="hkidno">No. of kids : </label>
										<input type="number" id="hkidno" name="hkidno" value="0" min="0" max="2" />
										
									</div>
									<div class="col s5">
									<label for="hkidage">Age of the Eldest</label>
										<input type="number" id="hkidage" name="hkidage" min="0" max="30" / >
										
									</div>
								</div>
								</div>
							</div>
						</li>
						<li>
							<!--style="display:none"-->
							<div class="collapsible-header">
								<!--<i class="material-icons">assessment</i>-->Coverage &amp; Premium Details</div>
							<div class="collapsible-body">
								<div class="row">
									<h6 class="col-md-3">I need a sum assured of <i class="fa fa-inr" style="vertical-align:middle;float: right;" aria-hidden="true"></i>
									</h6>
									<div class="col-md-2">
										<input type="number" name="hiamount" placeholder="Assured Amount" min="200000" max="1000000" value="200000" class="validate"/>
									</div>
									<h6 class="col-md-2">for a term of</h6> 
									<select name="siterm" class="browser-default col-md-1" >
										<option value="10" selected>10</option>
										<option value="20">20</option>
										<option value="20">40</option>
										<option value="85">Life Time</option>
									</select>
							<h6 class="col-md-2">years</h6> 									.
								</div>
								<div class="row">
									<h6 class="col-md-3">Premium frequency :</h6> 
									<select class="browser-default col-md-2" name="hinterval">
										<option value="1" selected>Yearly</option>
										<option value="2">Half-Yearly</option>
										<option value="12">Monthly</option>
									</select>
								</div>
							</div>
						</li>
					</ul>

						<ul id="home" class="collapsible" style="display:none" data-collapsible="accordion">
							<li>
								<!--style="display:none"-->
								<div class="collapsible-header">
									<!--<i class="material-icons">assessment</i>-->Location Details</div>
								<div class="collapsible-body">
									<div class="row">
									<div class="input-field col s6">
										<input type="number" id="ipincode" name="ipincode" min="100000" max="999999" />
										<label for="ipincode">Risk Location Pincode :</label>
										<p class="help-block">6-digit pincode of location</p>
									</div>
									</div>
								</div>
							</li>
							<li>
								<!--style="display:none"-->
								<div class="collapsible-header">
									<!--<i class="material-icons">assessment</i>-->Coverage Details</div>
								<div class="collapsible-body">
									<div class="row">
										<div class="input-field col s5">
											<input type="number" id="iconstruction" name="iconstruction" value="100000"  min="100000"  max="10000000"/>
											<label for="iconstruction">Sum you want to insure for construction :  <i class="fa fa-inr" style="vertical-align:middle;" aria-hidden="true"></i></label>
											<p class="help-block">It can maximum be  <i class="fa fa-inr" style="vertical-align:middle;" aria-hidden="true"></i> 1,00,00,000</p>
										</div>
										<div class="input-field col s5">
											<input type="number" id="icontent" name="icontent" value="80000" min="80000" max=" 500000"/>
											<label for="icontent">Sum you want to insure for content :  <i class="fa fa-inr" style="vertical-align:middle;" aria-hidden="true"></i></label>
											<p class="help-block">It can maximum be  <i class="fa fa-inr" style="vertical-align:middle;" aria-hidden="true"></i> 5,00,000</p>
										</div>
										<div class="input-field col s2">
										<label for="houseage">Year</label>
											<input type="number" id="houseage" name="houseage" value="2000" min="2000" max="2017" class="validate"/>
											<p class="help-block">Year of construction</p>
										</div>
									</div>
									<div class="row">
									<label class="col s3" style="font-size:15px">Policy Term</label>
									<select id="hterm" name="hiterm" class="browser-default col s3" >
										<option value="5" selected>5</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
									</select>
									</div>
								</div>
							</li>
						</ul>
						<ul id="auto" class="collapsible" style="display:none" data-collapsible="accordion">
						<li>
							<!--style="display:none"-->
							<div class="collapsible-header">
								<!--<i class="material-icons">assessment</i>-->Car Details</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="col s4">
									<label for="imanufacturer">Manufacturer</label>
										<select id="imanufacturer" name="imanufacturer" class="browser-default">
										<option value="0" selected>Choose Manufacturer</option>
									<?php
									$carmanufacturersql = "select distinct manufacturer from carrisk";
									$result = mysql_query($carmanufacturersql);
									while($row = mysql_fetch_assoc($result)){
										echo "<option value='".$row['manufacturer']."'>".$row['manufacturer']."</option>";
									}
										?>
									</select>
									</div>
									<div class="col s4">
									<label for="imodel">Model Name</label>
									<select id="imodel" class="browser-default" name="imodel">
										<option value="0" selected>Choose Model</option>
									</select>
									</div>
									
									<div class="col s4">
									<label for="cipurchase">Purchase Date : </label>
										<input type="date" id="cipurchase" name="cipurchase"  min="2013-12-31" max="2017-11-07" />
									</div>
								</div>
							</div>
						</li>
						<li>
							<!--style="display:none"-->
							<div class="collapsible-header">
								<!--<i class="material-icons">assessment</i>-->Driver Details</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="input-field col s2">
										<label>Driver : </label>
									</div>
									<div class="input-field col s5">
										<input type="number" id="ciage" name="ciage" min="18" max="99" />
										<label for="ciage">Age</label>
									</div>
									<div class=" col s5">
									<label for="cigender">Gender </label>
										<select name="cigender" class="browser-default">
										<option value="1" selected>Male</option>
										<option value="2">Female</option>
									</select>
									</div>
									</div>
								</div>
							</li>
							<li>
								<!--style="display:none"-->
								<div class="collapsible-header">
									<!--<i class="material-icons">assessment</i>-->Policy Coverage Details</div>
								<div class="collapsible-body">
								<div class="row">
									
									<div class="input-field col s4">
										<input type="number" id="ciamount" name="ciamount" min="100000" max="2000000" />
										<label for="ciamount">Coverage Amount : </label>
									</div>
									<div class="input-field col s4">
										<input type="number" id="citerm" name="citerm" min="5" max="20" />
										<label for="citerm">Policy Term </label>
									</div>
									<div class="control col s4"style="padding-top:20px">
										<input type="checkbox" class="filled-in" id="AccidentCoverage" name="AccidentCoverage" checked="checked"/>
										<label for="AccidentCoverage">Include Accidental Coverage</label>
									</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="submit-wrap">
						<button class="btn btn-info submit" name="quote" type="submit">Get Quote</button>
					</div>
				</form>
			</div>
			<?php include('footer.php') ?>
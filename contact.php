<?php
 include('header.php');
  ?>
  <div class="container-fluid" style="padding-left:5%;padding-right:5%">
  <h3 class="page-header">Contact us</h3>
<div>
	   <?php
   if(isset($_POST["contact"])){
	 include('db.php');
	 if(isset($_POST["feedback"]))
			$isfeedback = 1;
		else
			$isfeedback=0;
	 $name = $_POST["name"];
	 $mail = $_POST["mail"];
	 $msg = $_POST["msg"];
	 
	 $sql = "INSERT INTO `queries`(`name`, `email`, `message`, `isfeedback`) VALUES ('".$name."','".$mail."','".$msg."',".$isfeedback.")";
	 if(mysql_query($sql)){
		 echo "<span style='color:green;font-size:20px'>Your message has been posted successfully !!</span>";
	 }
	 else{
		 echo "<span style='color:red;font-size:20px'>Something went wrong !!</span>";
	 }
 }?>
</div>
  <div class="col-sm-8">
  <div class="card" style="padding:30px">
    <form action="" method="POST">
	<div class="row">
        <div class="control right">
          <input type="checkbox" class="filled-in" id="feedback" name="feedback"/>
		<label for="feedback">Feedback</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field">
		<i class="material-icons prefix">account_circle</i>
          <input id="name" type="text"  name="name" class="validate">
          <label for="name" >Name</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field">
		<i class="material-icons prefix">mail</i>
          <input id="email" type="email" name="mail" class="validate">
          <label for="email" >Email</label>
        </div>
      </div>
	  <div class="row">
        <div class="input-field">
		<i class="material-icons prefix">mode_edit</i>
          <textarea id="msg" name="msg" class="materialize-textarea"></textarea>
          <label for="msg">Message </label>
        </div>
      </div>
	  <div class="row">
		<div class="input-field submit-wrap right">
			<button class="btn btn-info submit" name="contact" type="submit">Post</button>
		</div>
      </div>
  </form>
</div>
</div>
<div class="col-sm-4">
	<div class="card" style="padding:30px;">
		<h5>Branch Office Location</h5>
		<div class="row">
			<blockquote>
      <b>Trishu Insurance Company </b><br/><br/>
		Barfung Block <br/>Ravangla Sub-Division <br/>
		South Sikkim - 737 139 <br/><br/>
		Office : +91 8670364931 <br/>
		Fax : +91 03595 260042
    </blockquote>
		</div>
	</div>
</div>
</div>

<?php include('footer.php'); ?>

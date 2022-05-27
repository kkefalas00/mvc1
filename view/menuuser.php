<?php 
if(@$_SESSION["uid"]!="")
{

?>
<nav class="navbar navbar-inverse" id=nav1>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?q=mainuser" id=dd1>Main</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?q=profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
		<li id=md1><a onclick="$('#myModal2').modal('show');"><span class="glyphicon glyphicon-expand"></span> Create Content</a></li>
        <li><a href="index.php?q=mycontent"><span class="glyphicon glyphicon-list"></span> My Content</a></li>
		<li><a href="index.php?q=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
}

else
{
	die();
}

?>

<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create New Content</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" id='frm_cnt' enctype="multipart/form-data">

			<div class="form-group">
				<input type="text" class="form-control" id="descr" name="descr" placeholder="Description: ex. This is a new content" required>
			</div>
			<div class="form-group">
			   <input type="text" class="form-control" id="title" name="title" placeholder="Title: ex: Content 1"required>
			</div>
			
			<div class="form-group">
			   <input type="file" accept="audio/*,video/*,image/*" capture="camera" class="form-control" id="cntdata" name="cntdata" placeholder="Content data" required>
			</div>
  
			<button type="submit" class="btn btn-default" onclick="">Create</button>
		</form>
		
		<div id=message style='text-align:center;'>
		</div>
      </div>

	<!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>

</div>
<div class=container>
	<div class=row >
		<div class=col-md-1></div>
		<div class=col-md-10 id=tbl1>
			<table class="table table-hover tt">
			<tr><th>Title</th><th>Description</th><th>Data</th><th>Delete</th></tr>
			<tbody id=list>
			
			</tbody>
			</table>
		</div>
	<div class=col-md-1></div>
	</div>
</div>

<div class=row>

	<div class=col-md-4></div>
	<div class=col-md-4>
		<div id=msg>

		</div>
	</div>
	<div class=col-md-4></div>

</div>

<input type='hidden' value='' name=idc id=idc>



<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete content</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Do you want to delete this content?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='deletecont()'>Yes</button><button type="button" class="btn btn-danger" data-dismiss="modal">No</button> 
      </div>

    </div>
  </div>

</div>

<script>
	getContent();
	
</script>


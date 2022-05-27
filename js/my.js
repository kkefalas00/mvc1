$(document).ready(function() {
	
	$("#bt2").click(function() {
		
		$(".tt1").toggle( "slow", function() {
		   
		});
	});
	
	
	
	$("#frm_signup").submit(function(){
		event.preventDefault();
		$.post("index.php?q=ins",$("#frm_signup").serialize(),function(res){
			if(res=="1"){
				$(".tt1").hide(2000);
				$("#msg").html("<div class='alert alert-success msgs'>New user is inserted. Login to see your content</div>");
			}
			else
			{
				$("#msg").html("Error User");
			}
		
		});
	
	
	});
	
	
	
	$("#frm_login").submit(function(){
		event.preventDefault();
		$.post("index.php?q=log",$("#frm_login").serialize(),function(res){
			if(res=="1")
			{	
			 window.location.href="index.php?q=mainuser";
			}
			else
			{
				$("#msg").html("<div class='alert alert-danger msgs'>User is not found</div>");
			}
		
		});
	
	
	});
	
	
	$("#frmprof").submit(function(){
		event.preventDefault();
		$.post("index.php?q=update",$("#frmprof").serialize(),function(res){
			if(res=="1"){
				$("#msg").html("<div class='alert alert-success msgs'> New data is Saved </div>");
			}
			else
			{
				$("#msg").html("<div class='alert alert-danger msgs'> Error during process </div>");
			}
		
		});
	
	
	});
	
	
$("#frm_cnt").submit(function(){
		event.preventDefault();
	
		  var fd = new FormData();
		  fd.append('title', $('#title').val());
		  fd.append('descr', $('#descr').val());
		 
		  fd.append('cntdata', $('#cntdata')[0].files[0]);
			   $.ajax({
				   url: "index.php?q=create",
				   type: 'POST',
				   data: fd,
				   enctype: 'multipart/form-data',
				  
				   success: function (res) {
					
					   
						if(res=="1")
						{
							$("#frm_cnt").hide(2000);
							$("#message").html("<div class=\"alert alert-success msgs\">New Content is inserted</div>");
							getContent();
							
						}
						else
						{
							$("#message").html("<div class=\"alert alert-danger msgd\">Error during process</div>");
							
						}
						
				   },
				   cache: false,
				   contentType: false,
				   processData: false
			   });
			
});
	
	
	
	
    
});

function usercontent(k)
{
	return `<tr class='ttrr1'>
			<td> ${k.titlos}</td>
			<td> ${k.descr}</td>
			<td> <img src='uploads/${k.filename}' width=80px></td>
			<td> <a onclick="$('#idc').val(${k.idc}); $('#myModal').modal('show')"><span class='glyphicon glyphicon-trash' id=bb2></span></a></td></tr>`;
}

function getContent()
{
		$.getJSON("index.php?q=getcont",function(res){
			var K=res;
			$("#list").html("");
			K.forEach((k) => 
			{  $("#list").append(usercontent(k));  });
			
		});
	
}

function userContents(c)
{
	return `<tr class='tr1'>
				<td> ${c.titlos}</td>
				<td> ${c.descr}</td>
				<td> <img src='uploads/${c.filename}' width="80px"></td>
			</tr>`;
}

function getAllContent()
{
		$.getJSON("index.php?q=getAllContents",function(res){
			var C=res;
			$("#list1").html("");
			C.forEach((c)=>
			 {	 $("#list1").append(userContents(c)) ;  });
	
	});
}

function deletecont()
{
	
	
	x=$("#idc").val();
	
	
	if(x!="")
	{
		
		$.getJSON("index.php?q=delcont&idc="+x,function(res){
			if(res=="1")
					{
						$("#msg").html("<div class=\"alert alert-success msgd\">Content is deleted</div>");
						$("#msg").hide(3000);
						getContent();
						
					}
					else
					{
						$("#msg").html("<div class=\"alert alert-danger msgd\">Error during process</div>");
						$("#msg").hide(4000);
					}
			
		});
	}
	
}
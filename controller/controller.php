<?php


include ("config.php");
include ("model/model.php");




if(@$_GET["q"]=="")
	{
		$menu="menu.php";
		$page="page1.php";
		include("view/master.php");
	}
	
if(@$_GET["q"]=="signup")
	{
		$menu="menu.php";
		$page="page1.php";
		include("view/master.php");
	}
	
	
	if(@$_GET["q"]=="ins")
	{
		$eml=$_POST['email'];
		$p=$_POST['pwd'];
		$fn=$_POST['fnm'];
		$u=new User();
		$u->set(0,$eml,$p,$fn);
		try{
			$u->insert_to_DB();
			echo 1;
			
		}
		catch(Exception $e){
			echo 0;
		
		}
		
	}
	
	
	if(@$_GET["q"]=="login")
	{
		$menu="menu.php";
		$page="login.php";
		include("view/master.php");
	}
	
	

	if(@$_GET["q"]=="log")
	{
	
		$e=$_POST['email'];
		$p=$_POST['pwd'];
		
		$u=User::find_DB($e,$p);
	
		if ($u==null)
		{
			echo 0;
			$_SESSION["uid"]="";
		}
		else
		{
			$_SESSION["uid"]=$u->id;
			echo 1;
		
		}
		
	}
	
	if(@$_GET["q"]=="mainuser")
	{
		if(@$_SESSION["uid"]!="")
		{
			$menu="menuuser.php";
			$page="mainuser.php";
			include("view/master.php");
		}
		else
			{
				die();
			}
		
	}
	
	
	if(@$_GET["q"]=="logout")
	{
			if(@$_SESSION["uid"]!="")
			{
				session_destroy();
				session_start();
				$menu="menu.php";
				$page="page1.php";
				
				include "view/master.php";
			}
			else
			{
				die();
			}
	}
	
	if(@$_GET["q"]=="profile")
	{
		if(@$_SESSION["uid"]!="")
		{
			$u=User::find_DB_using_id($_SESSION["uid"]);
			$menu="menuuser.php";
			$page="profile.php";
			include("view/master.php");
		}
		else
		{
			
			die();
		}
	}
	
	

	if(@$_GET["q"]=="update")
		
	{
		if(@$_SESSION["uid"]!="")
		{
			$eml=$_POST['email'];
			$p=$_POST['pwd'];
			$fn=$_POST['fn'];
			$u=User::find_DB_using_id($_SESSION["uid"]);
				try
				{
					$u->update($eml,$p,$fn);
					$u->update_to_DB();
					echo 1;
					
				}
				catch(Exception $e)
				{
					echo 0;
				
				}
		}
		else
		{
			die();
		}
		
	}
	
	if(@$_GET["q"]=="create")
		
	{
		if(@$_SESSION["uid"]!="")
		{
			$ttl=$_POST['title'];
			$desc=$_POST['descr'];
			$cnt=$_FILES['cntdata'];
			
			$u=User::find_DB_using_id($_SESSION["uid"]);
			
				try
				{
					
					$c=new Content();
					
					
					$c->setContent(0,"",$ttl,$desc,$cnt["name"],$u);
					echo ($c->insertCont_to_DB($cnt));
					
					
					
						
					
				}
				catch(Exception $e)
				{
					echo 0;
				
				}
		}
		else
		{
			die();
		}
		
	}
	
	if(@$_GET["q"]=="mycontent")
	{
		if(@$_SESSION["uid"]!="")
		{
			$u=User::find_DB_using_id($_SESSION["uid"]);
			$menu="menuuser.php";
			$page="contentlist.php";
			include("view/master.php");
		}
		else
		{
			
			die();
		}
	}
	
	if(@$_GET["q"]=="getcont")
	{
		if(@$_SESSION["uid"]!="")
		{	
			$u=User::find_DB_using_id($_SESSION["uid"]);
			$u=Content::getAllContWhere(" idu='$_SESSION[uid]'");
			echo json_encode($u);
			
		}
		else
		{
			
			die();
		}
	}
	
	
	if(@$_GET["q"]=="getAllContents")
	{
		if(@$_SESSION["uid"]!="")
		{	
			$u=Content::getAllContent();
			echo json_encode($u);
		}
		else
		{
			
			die();
		}
	}
	
		
	if(@$_GET["q"]=="delcont")
	{
		if(@$_SESSION["uid"]!="")
		{
			
			try
			{
				$c=Content::findCont_DB_using_id($_GET['idc']);
				$c->deleteCont_from_DB();
				
				echo 1;
			
			}
			catch(Exception $e)
			{
				echo 0;
		
			}
			
		}
		else
		{
			
			die();
		}
	}
	
	

?>
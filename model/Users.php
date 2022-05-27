<?php

 class User {
	 
		public $id;
		public $email;
		public $password;
		public $fullname;
		
		function construct()
		{
			$this->id=0;
			$this->email="";
			$this->password="";
			$this->fullname="";				
		}
	 
		
		function get()
		{
			return json_encode($this);
		
		}
		
		function set($id,$em,$p,$fn)
		{
			$this->email=$em;
			$this->id=$id;
			
			if($p!="")
			{
				$this->password=md5($p);
			}
			$this->fullname=$fn;
			
		}
		
		
		function update($em,$p,$fn)
		{
			$this->email=$em;
			
			if($p!="")
			{
				$this->password=md5($p);
			}
			
			$this->fullname=$fn;
		
		}
		
		
		function insert_to_DB()
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			if(mysqli_query($conn,"insert into users(id,fullname,email,pwd) values 
								(NULL,'$this->fullname','$this->email','$this->password')"))
								{
									$this->id=mysqli_insert_id($conn);
									mysqli_close($conn);
									return 1;
								}
								else
								{
									mysqli_close($conn);
									return 0;
									
								}		
		}

		function update_to_DB()
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$p=$this->password;
			if($p!='')
			{
			
				$p=$this->password;
				if(mysqli_query($conn,"update users 
										set fullname='$this->fullname',pwd='$p',
										email='$this->email' where id=$this->id")) 
									{
										mysqli_close($conn);
										return 1;
									}
									
									else
									{
										mysqli_close($conn);
										return 0;
										
									}
			}
			
			if($p=='')
			{
				if(mysqli_query($conn,"update users 
										set fullname='$this->fullname',
										email='$this->email' where id=$this->id")) 
									{
										mysqli_close($conn);
										return 1;
									}
									else
									{
										mysqli_close($conn);
										return 0;
										
									}
			}
			
		}
		
		public static function find_DB($e,$p)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$ss="select * from users where email='$e' and pwd='".md5($p)."'";
			$q=mysqli_query($conn,$ss);
		
			if(mysqli_num_rows($q)>0)
			{
		
				$r=mysqli_fetch_array($q);
				$u=new User();
				$u->set($r['id'],$r['email'],$r['pwd'],$r['fullname']);
				return $u;

			}
			else
			{
				
				return null;
			}
				
		}
		
		public static function find_DB_using_id($id)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from users where id='$id' ");
			if(mysqli_num_rows($q)>0)
			{
			
				$r=mysqli_fetch_array($q);
				$u=new User();
				$u->set($r['id'],$r['email'],$r['pwd'],$r['fullname']);
				return $u;

			}
			else
			{
				$u=new User();
				return $u;
			}
		
		}
		
		
		public static function getAll()
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from users ");
		
			$U=[];
			while($r=mysqli_fetch_assoc($q))
			{
				$U[]=$r;
			}
			return json_encode($U);	
		}

		public static function getAllWhere($query)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from users where $query ");
		
			$U=[];
			while($r=mysqli_fetch_assoc($q))
			{
				$U[]=$r;
			}
			return json_encode($U);	
		}


		function deleteUser_from_DB()
	{
		$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
		mysqli_query($conn,"set names 'utf8'");
		if(mysqli_query($conn,"delete from users where id=$this->id")) 
							{
								mysqli_close($conn);
								return 1;
							}
							else
							{
								mysqli_close($conn);
								return 0;
								
							}
	}
		
	}


?>
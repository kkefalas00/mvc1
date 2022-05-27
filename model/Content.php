<?php
	
	class Content{
		
			public $id;
			public $typos;
			public $titlos;
			public $descr;
			public $filename;
			public $user;
		
		
		
		function __construct() {
			$this->id =0;
			$this->typos = "";
			$this->titlos = "";
			$this->descr="";
			$this->filename="";
			$this->user="";
	
		}
		
		
		
		function setContent($id,$t,$ttl,$des,$filnm,$usr)
		{
			$u=$usr;
			if($u!=null)
			{
				$this->id = $id;
				$this->typos = $t;
				$this->titlos = $ttl;
				$this->descr = $des;
				$this->filename = $filnm;
				$this->user=$u;
			}
			else
			{
				throw new Exception('This user does not exist');
			}
		}
		
		function updateCont($t,$ttl,$des)
		{
			$this->typos=$t;
			$this->titlos=$ttl;
			$this->descr=$des;
		
		}
		
		function insertCont_to_DB($cnt)
		{
			
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			
				$p=pathinfo($this->filename);
					$ext=$p["extension"];
					$t="other";
					if($ext=="jpg" || $ext=="gif" || $ext=="png")
					{
						
						$t="file";
					}
					
					if($ext=="mov" || $ext=="avi" || $ext=="mp4")
					{
						
						$t="video";
					}
					
					if($ext=="aud" || $ext=="wav" || $ext=="mp3")
					{
						
						$t="audio";
					}
					
					if($ext=="doc" || $ext=="docx" || $ext=="pdf")
					{
						
						$t="document";
					}
			
			$this->typos=$t;
			
			
			$fn=rand(1000,9999).rand(1000,9999).rand(1000,9999).rand(1000,9999).$this->user->id.".$ext";
			if(move_uploaded_file($cnt["tmp_name"],"uploads/$fn"))
			{
							$this->filename=$fn;
							
							
							if(mysqli_query($conn,"insert into content(idc,titlos,idu,descr,typos,filename) values 
								(NULL,'$this->titlos','".$this->user->id."','$this->descr','$this->typos','$this->filename')"))
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
			else
			{
				echo "error";
			}
		
		}
		
		
		function updateCont_to_DB()
		{
				$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
				mysqli_query($conn,"set names 'utf8'");
				if(mysqli_query($conn,"update content 
										set titlos='$this->titlos',descr='$this->descr' ,
										typos='$this->typos' where idc=$this->id")) 
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
			
		function UpdateData_to_DB()
		{
			
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
				mysqli_query($conn,"set names 'utf8'");
				if(mysqli_query($conn,"update content 
										set filename='$this->filename' where idc=$this->id")) 
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
		
		public static function find_DB_Cont($t,$ttl,$des)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from content where typos='$t', titlos='$ttl' and descr='$des' ");
			if(mysqli_num_rows($q)>0)
			{
			
				$r=mysqli_fetch_array($q);
				$u=new Content();
				$u->setContent($r['idc'],$r['titlos'],$r['idu'],$r['descr'],$r['typos'],$r['filename']);
				return $u;

			}
			else
			{
				$u=new Content();
				return $u;
			}
				
		}
		
		public static function findCont_DB_using_id($id)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from content where idc='$id' ");
			if(mysqli_num_rows($q)>0)
			{
			
				$r=mysqli_fetch_array($q);
				$u=new Content();
				$u->setContent($r['idc'],$r['titlos'],$r['idu'],$r['descr'],$r['typos'],$r['filename']);
				return $u;

			}
			else
			{
				$u=new Content();
				return $u;
			}
		
		}
		
		
		public static function getAllContent()
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from content ");
			$C=$q->fetch_all(MYSQLI_ASSOC);
			
			return $C;	
		}
		
		
		public static function getAllContWhere($query)
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			$q=mysqli_query($conn,"select * from content where $query ");
		
			$K=$q->fetch_all(MYSQLI_ASSOC);
			
			return $K;	
		}


		function deleteCont_from_DB()
		{
			$conn=mysqli_connect($GLOBALS["server"],$GLOBALS["dbuser"],$GLOBALS["dbpass"],$GLOBALS["db"]);
			mysqli_query($conn,"set names 'utf8'");
			if(mysqli_query($conn,"delete from content where idc=$this->id")) 
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
<?php
@session_start();

include("include/sambung_other.php");

$db_server 	= $db_host;
$db_database = $db_name;
$db_user 	= $db_user;
$db_password = $db_pass;

backup_tables($db_server,$db_user,$db_password,$db_database);

/* backup the db OR just a table */	
function backup_tables($db_server,$db_user,$db_password,$name,$tables = '*')
{
	
	$link = @mysql_connect($db_server,$db_user,$db_password);
	@mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = @mysql_query('SHOW TABLES');
		while($row = @mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	
	//cycle through
	foreach($tables as $table)
	{
		$result = @mysql_query('SELECT * FROM '.$table);
		$num_fields = @mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = @mysql_fetch_row(@mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n". $row2[1] . ";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = @mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = @addslashes($row[$j]);
					$row[$j] = @ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	
	//======trigger--------
	$triggers = array();
	$result2 = @mysql_query('SHOW TRIGGERS');
	while($row2 = @mysql_fetch_row($result2))
	{
		$triggers[] = $row2[0];
	}
	
	foreach($triggers as $trigger)
	{
		
		$return2.= 'DROP TRIGGER IF EXISTS '.$trigger.'; 
		DELIMITER // ';
		$row3 = @mysql_fetch_row(mysql_query('SHOW CREATE TRIGGER '.$trigger));
		$return2.= "\n\n". $row3[2] . " 
		//
		DELIMITER ;\n\n";
		
		$return2.="\n\n\n"; 
		
		/*
		$return2.= 'DROP TRIGGER IF EXISTS '.$trigger.'; 
		';
		//$row3 = mysql_fetch_row(mysql_query('SHOW CREATE TRIGGER '.$trigger));
		$return2.= "\n\n"; 
		
		$return2.="\n\n\n"; */
	}
	
	$return = $return . $return2;
	//---------end trigger-----
	
	
	//======View--------
	$views = array();
	$result2 = @mysql_query('SHOW CREATE VIEW');
	while($row2 = @mysql_fetch_row($result2))
	{
		$views[] = $row2[0];
	}
	
	foreach($views as $view)
	{
		
		$return2.= 'DROP VIEW IF EXISTS '.$view.'; 
		DELIMITER // ';
		$row3 = @mysql_fetch_row(mysql_query('SHOW CREATE VIEW '.$view));
		$return2.= "\n\n". $row3[2] . " 
		//
		DELIMITER ;\n\n";
		
		$return2.="\n\n\n"; 
		
		/*
		$return2.= 'DROP TRIGGER IF EXISTS '.$trigger.'; 
		';
		//$row3 = mysql_fetch_row(mysql_query('SHOW CREATE TRIGGER '.$trigger));
		$return2.= "\n\n"; 
		
		$return2.="\n\n\n"; */
	}
	
	$return = $return . $return2;
	//---------end view-----
	
	
	//save file
	//$handle = fopen('../../database_backup\db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	
	$date = date("Y-m-d");
	$filedb = 'db-backup-' . $date . '-' . time();
	
	$handle = fopen('database_backup/' . $filedb . '.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	
	if($handle) {
		echo "Backup Database sukses....";
		
	} else {
		echo "Backup Database gagal....";
	}
	
	$_SESSION['filedownload'] = $filedb . ".sql";
}

?>

<script>
	location="backup_download_db.php";	
</script>
<?php

// loop array for database
backup_tables('localhost','root','root','ebdb');

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$db = new PDO('mysql:host='.$host.';dbname='.$name.';',$user,$pass);
	$db->query('SET NAMES utf8');
	$db->num_queries=0;
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$q = $db->query('SHOW TABLES');
		if(!$q) return false;
		$result=array();
		while($r=$q->fetch(PDO::FETCH_NUM))$result[]=$r;
		
		foreach($result as $row)
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	$return = '';
	//cycle through	
	foreach($tables as $table)
	{
		$q = $db->query('SELECT * FROM '.$table);
		if(!$q) continue;
		$result=array();
		while($r=$q->fetch(PDO::FETCH_NUM))$result[]=$r;

		$num_fields = $q->columnCount();
		$return.= 'DROP TABLE '.$table.';';
		$q2 = $db->query('SHOW CREATE TABLE '.$table);
		if(!$q2) continue;
		$row2 = $q2->fetch(PDO::FETCH_NUM);
		$return.= "\n\n".$row2[1].";\n\n";
		foreach($result as $row)
		{
			$return.= 'INSERT INTO '.$table.' VALUES(';
			for($j=0; $j < $num_fields; $j++) 
			{
				//var_dump($row[$j]);
				$row[$j] = addslashes($row[$j]);
				// $row[$j] = preg_replace("\n","\\n",$row[$j]);
				if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
				if ($j < ($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
		}
		
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
<?php
// include database file
include '_db.php';
$db	= new Baza();

// define tables
$tl 	= "`list`";
$tlk 	= "`words`";

$s = "CREATE TABLE IF NOT EXISTS $tl ( ";
$s .=" `lang_id` 		int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
$s .=" `lang_name` 		varchar(50) NULL, ";
$s .=" `lang_code`		varchar(10) NULL, ";
$s .=" `lang_code2` 	varchar(20) NULL, ";
$s .=" `lang_state` 	varchar(40) NULL ";
$s .= ") ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";

$q1 = $db->db($s);


$s = "CREATE TABLE IF NOT EXISTS $tlk ( ";
$s .=" `word_id` 		int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
$s .=" `word_lang` 		varchar(5) NULL, ";
$s .=" `word_key` 		varchar(100) NULL, ";
$s .=" `word_text`		varchar(250) NULL ";
$s .= ") ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";

$q2 = $db->db($s);

function insertMulti($array = '')
{
	global $db, $tl, $tlk;
	
	if($array === ''):
		echo "Gabim ne array bosh.";
		return false;
	endif;
	
	#mysqli_set_charset($db,"utf8");
	
	$s = "INSERT INTO $tlk (`word_lang`, `word_key` , `word_text`) VALUES ";
		
	foreach($array as $lang=>$wrd):
	
		$lang = $db->mprp($lang);
		$i = 1;
		$r = 1;
		$c = count($wrd);
		foreach($wrd as $key=>$val):
			if(!empty($val))
			{
				$key = $db->mprp($key);
				$val = $db->mprp($val);
				
				if($i === $c-1)
					$s .=" ('$lang', '$key', '$val') ";
				else
					$s .=" ('$lang', '$key', '$val'), ";
			}
			$i++;
	
		endforeach;

	endforeach;
	
	$db->db($s);
	
}

function updateWord($ps = array(), &$hnd)
{
	global $db, $tl, $tlk;
	
	if(empty($ps))
		return false;
	
	$ls = getListAll();
	
	$hnd['01 GET KEY'] = $ps['gk'];
	$hnd['02 DB KEY'] = $ls[$ps['gk']];
	
	if(array_key_exists($ps['gk'], $ls))
	{
		
		$hnd['03 KEY STATUS'] = 'found';
		
		$hnd['04 GET LANG'] = $ps['gl'];
		$hnd['05 DB WORD'] = $ls[$ps['gk']];
		
		if(isset($ls[$ps['gk']][$ps['gl']]))
		{
			$hnd['LANGSTS'] = 'found';
			$s = "UPDATE $tlk SET `word_text`='".$db->mprp($ps['gw'])."' WHERE ";
			$s .=" `word_key` = '".$db->mprp($ps['gk'])."' AND `word_lang`='".$db->mprp($ps['gl'])."'";
			$hnd['sql'] = $s;
		}
		else
		{
			$hnd['LANGSTS'] = 'not found';
			$s = "INSERT INTO $tlk (`word_lang`, `word_key`, `word_text`) ";
			$s .="VALUES ('".$db->mprp($ps['gl'])."', '".$db->mprp($ps['gk'])."', '".$db->mprp($ps['gw'])."')";
			$hnd['sql2'] = $s;
		}
		
	}
	else
	{
		$s = "INSERT INTO $tlk (`word_lang`, `word_key`, `word_text`) ";
		$s .="VALUES ('".$db->mprp($ps['gl'])."', '".$db->mprp($ps['gk'])."', '".$db->mprp($ps['gw'])."'";
		$hnd['sql3'] = $s;
	}
	

	if($db->db($s))
		return true;
	else
		return false;
}

function removeWord($ps = array(), &$hnd)
{
	global $db, $tl, $tlk;
	
	if(empty($ps))
	{
		$hnd['error'] = 'Nuk ka asnje te dhene';
		return false;
	}
	
	$s = "DELETE FROM $tlk WHERE `word_key`='".$db->mprp($ps['gk'])."' ";
	$hnd['sql'] = $s;	

	if($db->db($s))
		return true;
	else
		return false;
}

function addWord($ps = array(), &$hnd)
{
	global $db, $tl, $tlk;
	
	if(empty($ps))
	{
		$hnd['error'] = 'Nuk ka asnje te dhene';
		return false;
	}
	
	$ls = getListAll();
	
	if(array_key_exists($ps['word_key'], $ls))
	{
		$hnd['error'] = 'Duplikat';
		return false;	
	}
	else
	{
		$s = "INSERT INTO $tlk (`word_lang`, `word_key`, `word_text`) VALUES ";
		$s .=" ('al', '".$db->mprp($ps['word_key'])."', '".$db->mprp($ps['word_al'])."'), ";
		$s .=" ('en', '".$db->mprp($ps['word_key'])."', '".$db->mprp($ps['word_en'])."'), ";
		$s .=" ('mk', '".$db->mprp($ps['word_key'])."', '".$db->mprp($ps['word_mk'])."') ";
		
		if($db->db($s))
		{
			$hnd['status'] = 'ok';
			return true;
		}
		else
		{
			$hnd['error'] = 'Database error';
			return false;
		}
	}
}

/*  getters	*/
function getListAll($hw = 'words')
{
	global $db, $tl, $tlk;
	
	$s = " SELECT * FROM $tlk LEFT JOIN $tl ON $tlk.`word_lang` =  $tl.`lang_code` ORDER BY `word_key` ASC";
	
	#echo $s;
	
	$q = $db->db($s);
	
	$arr = array();
	$unk = 1;
	while($r = $db->farr($q)):
		#var_dump($r);
		if($hw === 'words')
		{
			
			if($r['lang_code'] === null ):
				$arr[$r['word_key']]['udf_'.$unk] = $r['word_text'];
				$unk++;
			else:
				$arr[$r['word_key']][$r['lang_code']] = $r['word_text'];
			endif;
			
		}
		else
		{
			
			if($r['lang_code'] === null ):
				$arr[$r['lang_code']][$r['word_key']] = $r['word_text'];
				$unk++;
			else:
				$arr[$r['lang_code']][$r['word_key']] = $r['word_text'];
			endif;
			
		}
	endwhile;
	
	return $arr;
}


function dirToArray($dir ='', $ret = '') 
{
	$result = array();

	if(!is_dir($dir))
		return array();

	$cdir = scandir($dir); 
	foreach ($cdir as $key => $value) 
	{ 
		if (!in_array($value,array(".",".."))) 
		{ 
			if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
			{ 
				$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
			} 
			else 
			{
				if($ret === 'full')
					$result[] = $dir . DIRECTORY_SEPARATOR . $value;
				else
					$result[] = $value;
			} 
		} 
	}
	return $result; 
}


function checkChar4String($ch='', $string='')
{
	if(!empty($ch) && !empty($string)):

		if(gettype($ch) == 'array'){

			$ret = false;
			foreach($ch as $kr){

				$a = strpos($string, $kr);
				#   kontrollimi
				if ($a !== false)
					$ret =  true;
			}

			return $ret;

		}else{
			#   funksioni.
			$a = strpos($string, $ch);
			#   kontrollimi
			if ($a !== false)
				return true;
			else
				return false;

		}
	else:
		echo 'EMPTY';
	endif;
}


function _detectFileEncoding($filepath) {
    // VALIDATE $filepath !!!
	echo $filepath.'<br>';
    $output = array();
    exec('file -i ' . $filepath, $output);
	
	var_dump($output);
	
    if (isset($output[0])){
        $ex = explode('charset=', $output[0]);
        return isset($ex[1]) ? $ex[1] : null;
    }
    return null;
}
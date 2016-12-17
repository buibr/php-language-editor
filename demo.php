<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;UTF-8">
	<?php header('Content-Type: text/html; charset: utf-8'); ?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/rowreorder/1.1.1/css/rowReorder.dataTables.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/dataTables.jqueryui.min.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/rowreorder/1.1.1/js/dataTables.rowReorder.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".table").DataTable({
				"pageLength": 500
			});
		})
	</script>
</head>
<body>
	<div class="container">
		<?php
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
		
		function checkChar4String($ch='', $string=''){
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
		
		/* files	*/
		$bd = "F:/WEB/WEBS/wwwap/System/languages/";
		$makefile = false;
        
        //  get files from directory
		foreach(scandir($bd) as $file)
		{
			if(strpos($file, '.php'))
			{
				include $bd . $file;
			}
		}
        
		//	getting keys
		$keys = array();
		foreach($fjl as $k=>$v)
        {
			foreach($v as $kv=>$pv)
				if(!in_array($kv, $keys))
					$keys[] = $kv;
        }
        
		// change word
        $kkk = '';
		if(isset($_POST['submit']))
		{
            if(isset($_GET['change']))
            {
                if($_GET['change'] != '')
                {
                    
                    #var_dump($_POST);
                    #echo $fjl['al'][$_POST['key']] . '<Br/>';
                    #echo $fjl['mk'][$_POST['key']] . '<Br/>';
                    #echo $fjl['en'][$_POST['key']] . '<Br/>';
                    
                    $fjl['al'][$_GET['change']] = trim($_POST['al']);
                    $fjl['mk'][$_GET['change']] = trim($_POST['mk']);
                    $fjl['en'][$_GET['change']] = trim($_POST['en']);
                    $kkk = $_GET['change'];
                    
                    #echo $fjl['al'][$_POST['key']] . '<Br/>';
                    #cho $fjl['mk'][$_POST['key']] . '<Br/>';
                    #echo $fjl['en'][$_POST['key']] . '<Br/>';
                    
                }
            }
			else
            {
                if(!isset($keys[$_POST['key']]))
                {
                    var_dump($_POST);
                    $keys[] = $_POST['key'];
                    $fjl['al'][$_POST['key']] = $_POST['al'];
                    $fjl['mk'][$_POST['key']] = $_POST['mk'];
                    $fjl['en'][$_POST['key']] = $_POST['en'];
                    
                    $kkk = $_POST['key'];
                }
                else
                {
                    $kkk = $_POST['key'];
                }
            }
            
           $makefile = true;
		}
        
        
        if(isset($_GET['remove']))
        {
            
            var_dump($_GET);
            unset($keys[$_GET['remove']]);
            $makefile = true;
        }
        
        // building files.
        if($makefile === true):
		
            // categorising
            $arr = array();

            foreach ($keys as $key):

            	$key = str_replace('"', "'", $key);

            	if(in_array($key, $arr))
            	{

            	}
            	else
            	{
	                
	                if(checkChar4String(array('user', 'users', 'antar'),$key))
	                    $arr['users'][] 		= addslashes($key);
	                elseif(checkChar4String(array('product', 'products', 'cate', 'cat'),$key))
	                    $arr['products'][] 		= addslashes($key);
	                elseif(checkChar4String(array('chart', 'cart', 'order', 'orders','ord' ),$key))
	                    $arr['orders'][] 		= addslashes($key);
	                elseif(checkChar4String(array('time','day', 'date', 'data', 'koha', 'year','month', 'day', 'january', 'february', 'march', 'june', 'july', 'april','may', 'august','september','october','november', 'december'),$key))
	                    $arr['date'][] 		    = addslashes($key);
	                elseif(checkChar4String(array('msg', 'message', 'mesazh'),$key))
	                    $arr['messages'][] 		= addslashes($key);
	                elseif(checkChar4String(array('client', 'clients', 'cli', 'klient'),$key))
	                    $arr['messages'][] 		= addslashes($key);
	                elseif(checkChar4String(array('price', 'cmimi'),$key))
	                    $arr['price'][] 		= addslashes($key);
	                elseif(checkChar4String(array('cars', 'truck', 'taxi'),$key))
	                    $arr['cars'][] 		= addslashes($key);
	                else
	                    $arr['other'][] 		= addslashes($key);
	            }
            endforeach;
            
            
            // building files.
            $ll = array('al', 'mk', 'en');
            ///header("Content-Type: text/html; charset=utf-8");
            
            foreach ($ll as $lang):
                
                $file = $bd . '/' . $lang . ".php";
                
                if(is_file($file))
                {
                    
                    $dir = time();
                    if(!is_dir($bd . '/Backup/' . $dir))
                        mkdir($bd . '/Backup/' . $dir);
                    rename($file, $bd . '/Backup/'.$dir.'/backup_' . $lang  . ".php");
                    
                }
                $fp = fopen($bd . '/' . $lang . ".php", "w");
                fwrite($fp, "<?php");
                fwrite($fp, "\n");
                fwrite($fp, "/*		NRB Gjuha " . strtoupper($lang) . " - " . date('d.m.Y H:i:s')."\n");
                fwrite($fp, "**************************/\n");

                foreach ($arr as $type=> $key):
                    fwrite($fp, "\n");
                    fwrite($fp, "\n");
                    fwrite($fp, "#******* ".ucfirst($type)." ********\n");
                    fwrite($fp, "#***********************************\n");

                    foreach ($key as $k=>$v)
                    {
                        $len = strlen($v);
                        $t = "\t";
                        if($len < 3)
                            $t ="\t\t\t\t\t\t\t";
                        elseif($len < 7)
                            $t ="\t\t\t\t\t\t";
                        elseif($len < 11)
                            $t ="\t\t\t\t\t";
                        elseif($len < 15)
                            $t ="\t\t\t\t";
                        elseif($len < 19)
                            $t ="\t\t\t";
                        elseif($len < 23)
                            $t ="\t\t";
                        elseif($len < 27)
                            $t ="\t";


                        fwrite($fp, '$fjl["'.$lang.'"]["'.$v.'"] ='.$t.'	"'. html_entity_decode($fjl[$lang][$v]).'";'. "\n");

                    }

                endforeach;

                fwrite($fp, "\n");
                fwrite($fp, "?>");
                fclose($fp);
                chmod($bd . '/' . $lang . ".php", 0755);
            endforeach;
            
        endif;
        
		?>
		
		
		<div class="row">
			<form method="post">
				<div class="col-xs-6">
					<div class="form-group">
						<label for="key" class="label-control"> KEY: </label>
						<input type="text" name="key" class="form-control" value="<?=isset($_GET['change']) ? $_GET['change']: ""?>">
					</div>
					<div class="form-group">
						<label for="al" class="label-control"> al: </label>
						<input type="text" name="al" class="form-control" value="<?=isset($_GET['change']) ? trim($fjl['al'][$_GET['change']]) : ""?>">
					</div>
                </div>
                <div class="col-xs-6">
					<div class="form-group">
						<label for="mk" class="label-control"> mk: </label>
						<input type="text" name="mk" class="form-control" value="<?=isset($_GET['change']) ? trim($fjl['mk'][$_GET['change']]) : ""?>">
					</div>
					<div class="form-group">
						<label for="en" class="label-control"> en: </label>
						<input type="text" name="en" class="form-control" value="<?=isset($_GET['change']) ? trim($fjl['en'][$_GET['change']]) : ""?>">
					</div>
                </div>
                <hr>
                <div class="col-xs-12">
                    <button name="submit" type="submit" class="btn  btn-primary">ADD</button>
                </div>
			</form>
			<div class="clearfix"></div>
			<hr>
		</div>
		
		
		<table id="table_id" class="display table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Key</th>
					<th>Val AL</th>
					<th>Val MK</th>
					<th>Val EN</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				foreach ($keys as $key): ?>
				<tr id="#row<?=$key?>" >
					<td><?=$i?></td>
					<td><?=$key?></td>
					<td><?=isset($fjl['al'][$key]) ? $fjl['al'][$key] : "--"?></td>
					<td><?=isset($fjl['mk'][$key]) ? html_entity_decode($fjl['mk'][$key]) : "--"?></td>
					<td><?=isset($fjl['en'][$key]) ? $fjl['en'][$key] : "--"?></td>
					<td class="btn-group" >
                        <a href="?change=<?=$key?>#row<?=$key?>" class="btn btn-xs btn-primary">Change</a>
                        <a href="?remove=<?=$key?>#row<?=$key?>" class="btn btn-xs btn-danger">Remove</a>
                    </td>
				</tr>
				<?php 
					$i++;
				
				endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
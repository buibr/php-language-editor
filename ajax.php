<?php
session_start();
include 'functions.php';
header('Content-Type: application/json');

$arr['start'] = date('Y.m.d H:i:s');
if(isset($_GET['update'])): /// update an word

    $ps = $_POST;

    $arr['GET'] = $ps;
    $arr['status'] = 'no';
    if($upd = updateWord($ps, $arr))
    {
        $arr['status'] = 'ok';
        $arr['upd'] = $upd;
    }
    else
    {
        $arr['upd'] = $upd;
        $arr['status'] = 'Error updating this keyword in ' . $ps['gl'] . ' language.';
    }
endif;

//	me fshij nje fjal
if(isset($_GET['remove'])):

    $ps = $_POST;
    $arr['status'] = 'no';
    if(removeWord($ps, $arr))
    {
        $arr['status'] = 'ok';
    }
    else
    {
        $arr['status'] = 'Error deleting this keyword in ' . $ps['gl'] . ' language.';
    }
endif;


// me shtu nje fjal te re.
if(isset($_GET['add'])):

    $ps = $_POST;
    $arr = $ps;
    $arr['status'] = 'no';
    addWord($ps, $arr);

endif;


// me shtu nje fjal te re.
if(isset($_GET['changedir'])):

    if(isset($_POST['dir'])):
        if(is_dir(trim($_POST['dir']))):

            setcookie('dir',trim($_POST['dir']));

            $arr['status'] = 'ok';

        else:
            $arr['status'] = 'bad';
        endif;

    else:
        $arr['status'] = 'message';
        $arr['message'] = 'Nuk u dha direktoriumi';
    endif;

endif;


// me shtu nje fjal te re.
if(isset($_GET['save'])):

    set_time_limit(0);
    $lang 			= $_POST['lang'];
    $filename 		= $lang . ".php";
    $fg 			= 'download_ajax.php?lang='.$lang;
    $dir 			= isset($_COOKIE['dir']) ? trim($_COOKIE['dir']) :"";

    $df = $dir . DIRECTORY_SEPARATOR . $filename;
    $bdf = $dir . DIRECTORY_SEPARATOR . $filename . ".backup";

    if(is_file($df)):

        if(is_file($bdf)):
            unlink($bdf);
            rename($df, $bdf);
        else:
            rename($df, $bdf);
        endif;

    endif;


    $fp = fopen($df, 'w+');


    $list = getListAll('other');


    $re = "<?php \n/*	NRB Language " . date('Y.m.d') . "	*/ \n/***************************************/\n";
    foreach($list[$lang] as $k=>$v)
    {
        $len = strlen($k);
        
        $br = 50 - $len;
        $lr = "";
        for($i=1; $i <=$br; $i++)
            $lr .=" ";
        
        $v = str_replace("<", "\<", $v);
        $v = str_replace("\n", "\\n", $v);
        $v = str_replace('"', "'", $v);
        
        $re .= '$'."fjl['" . $lang . "']['" . $k . "'] =$lr".'"' . $v . '"'. ";\n";
        
    }
    $re .= "\n?>";

    fwrite($fp,$re);

    if(is_file($df)):
        $arr['status'] = 'ok';
    else:
        $arr['status'] = 'bad';
    endif;
    
endif;




print json_encode($arr);
?>
<?php
require_once "config.php";
require_once "lang/en.php";
function ClassAutoLoad($ClassName){
        $directories = array("contents","forms", "layouts", "globals", "processes");
        foreach($directories AS $dir){
            $FileName = dirname(__FILE__) . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $ClassName . ".php";
            if(is_readable($FileName)){
                require $FileName;
            }
        }
    }
    spl_autoload_register('ClassAutoLoad', true, true);

// instantiating classes
// creating objects.

$OBJ_Layout = NEW layouts();
$OBJ_Contents = NEW contents();
$OBJ_Forms = NEW forms();
$OBJ_SendMail = NEW SendMail();
$OBJ_Proc = NEW auth();


// Call methods
$OBJ_Proc->receive_sign_up($OBJ_SendMail, $lang, $conf);
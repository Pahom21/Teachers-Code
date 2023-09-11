<?php

class auth{
    public function bind_to_template($replacements, $template){
        return preg_replace_callback('/{{(.+?)}}/', function($matches) use ($replacements){
            return $replacements[$matches[1]];
        }, $template);
    }

    public function receive_sign_up($OBJ_SendMail, $lang, $conf){
        if(isset($_POST["signup"])){

            $email_address = addslashes($_POST["email_address"]);

            if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format");
            }else{
                $replacements = array('fullname'=>'Buddy', 'site_name'=>$conf["site_name"]);
                $OBJ_SendMail->SendeMail([
                    'email_receiver' => $email_address,
                    'name_receiver' => 'Buddy',
                    'email_subject_line' => $lang["sign_up_feedback_subject"],
                    'email_message' => $this->bind_to_template($replacements, $lang["sign_up_feedback"])
                ], $conf);
                header("Location: signin.php");
                exit();
            }
        }
    }
}
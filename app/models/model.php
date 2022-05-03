<?php
include "check.php";

use PHPMailer\PHPMailer\PHPMailer;

class model extends check
{

    public function random($n)
    {
        $char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!";
        $rand = '';
        for ($i = 0; $i < $n; $i++) {
            $rand .= $char[rand(0, strlen($char) - 1)];
        }

        return $rand;
    }


    function get_client_ip()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    function sqlBind($attrs)
    {
        $updateK = '';
        $keys = array_keys($attrs);
        for ($i = 0; $i < count($keys); $i++) {
            if ($i == (count($keys) - 1)) {
                $updateK .= $keys[$i];
            } else {
                $updateK .= $keys[$i] . ", ";
            }
        }

        $updateK = str_replace(":", " = ?", $updateK);

        return $updateK;
    }


    function getpath($t, $url)
    {
        $path = explode("/", $t->getPath());
        $url = preg_replace("/{.+?}/", $path[count($path) - 1], $url);
        return $url;
    }


    function returnData($attrs): array
    {
        $array = array();
        foreach ($attrs as $value) {
            array_push($array, $value);
        }
        // $array
        return $array;
    }






    function session($callback1 = '', $callback2 = '')
    {
        $user = $_SESSION['userData'] ?? '';
        if (
            isset($_SESSION['userData']->id)
            && isset($_SESSION['userData']->email)
        ) {
            if ($user->active == 1) {

                if ($callback1) {
                    $callback1($user);
                }
            } else {
                header("Location: /signout");
            }
        } else {
            if ($callback2) {
                $callback2($user);
            }
        }
    }







    function sendEmail($data = [
        'email' => "example@gmail.com",
        'name' => 'example',
        'subject' => 'Subject',
        'body' => 'body'
    ])
    {

        require  __DIR__ . '/PHPMailer/src/Exception.php';
        require  __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require  __DIR__ . '/PHPMailer/src/SMTP.php';

        $email = new PHPMailer(true);

        try {
            $email->isSMTP(); // Set emailer to use SMTP
            $email->CharSet = "utf-8"; // set charset to utf8
            $email->SMTPAuth = true; // Enable SMTP authentication
            $email->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

            $email->Host = 'smtp.gmail.com';
            $email->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );                                 //Enable SMTP authentication
            $email->Username   = 'baya3store09@gmail.com';                     //SMTP username
            $email->Password   = 'baya3StoRe010012';                               //SMTP password          //Enable implicit TLS encryption
            $email->Port       = 587;
            $email->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $email->setFrom('baya3store09@gemail.com', 'Mailer');
            $email->addAddress($data['email'], $data['name']);
            // $email->CharSet("UTF-8");
            $email->isHTML(true);                                  //Set email format to HTML
            $email->Subject = $data['subject'];
            $email->Body    = $data['body'];
            $email->AltBody = 'This is the body in plain text for non-HTML email clients';

            $email->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$email->ErrorInfo}";
        }
    }
}
<?php

namespace csoc\Alcatel;

use csoc\Alcatel\Constants;
// use csoc\Alcatel\GlobalFunction as Func;

/**
 * ALU Login
 */
class AluApi
{
    public function __construct($ipModem, $username, $password, $debug = false, $proxy = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->proxy = $proxy;

        if ($debug) {
            $this->$debug = true;
        }

        $this->modemUrl = "http://$ipModem";
    }

    /**
     * Fungsi untuk cek login
     *
     * @return boolean
     */
    public function login()
    {
        $url = $this->modemUrl . Constants::LOGIN;
        
        $postdata = [
            'name'       => $this->username,
            'pswd'       => $this->password,
        ];

        // login dan simpan cookies
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Fedora; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        curl_close($ch);
        
        if (strpos($data, 'login.cgi?out') != false) {
            $result = true;
        } else {
            if (strpos($data, 'Login') != false) {
                $result = false;
            } else {
                $result = false;
            }
        }
        return $result;
    }
}

?>
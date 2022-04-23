<? 
class Funcoes {
    
    public static function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
     
        return $ip;
    }

    public static function fdatahora($data,$tipo){
        $exData = substr($data,0,10);
        $exData = explode($tipo,$exData);
        if($tipo=='/'){
            $date = $exData[2].'-'.$exData[1].'-'.$exData[0];       
        }else if($tipo=='-'){
            $date = $exData[2].'/'.$exData[1].'/'.$exData[0];
        }else{
            return 'erro';
        }       
        return $date.substr($data,10,6);
    }

    public static function fdata($data,$tipo){
        $exData = substr($data,0,10);
        $exData = explode($tipo,$exData);
        if($tipo=='/'){
            $date = $exData[2].'-'.$exData[1].'-'.$exData[0];       
        }else if($tipo=='-'){
            $date = $exData[2].'/'.$exData[1].'/'.$exData[0];
        }else{
            return 'erro';
        }       
        return $date;
    }

    public static function aspectRatio($a, $b , $c = null) 
    {    
        $aa = $a;
        $bb = $b;
        
        while ($b != 0) {
            $remainder = $a % $b;  
            $a = $b;  
            $b = $remainder;  
        }    
        $gcd = abs ($a);  
        $a = $aa;
        $b = $bb;
        $a = $a/$gcd;  
        $b = $b/$gcd;  
        $ratio = $a . ":" . $b;  
        
        if (isset($c)){
            return array($ratio, $a, $b);
        } else {
            return $ratio;
        }
    }

    public static function urlAmigavel($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '-', $str);
        $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)
        return strtolower($str);
    }
}
?>
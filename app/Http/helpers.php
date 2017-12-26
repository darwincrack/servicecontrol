<?php
use Illuminate\Http\Request;
/**
 * Created by PhpStorm.
 * User: desarrollo
 * Date: 23/12/2016
 * Time: 11:55
 */

/**
 * desencripta una cadena de caracteres
 *@string Es la cadena a encryptar
 *@key Es la llave para encryptar
 */
function encriptar($string, $key='V3+5.1sewerew.4c7/s+-s') {
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
    }
    return base64_encode($result);
}

/**
 * desencripta una cadena de caracteres
 *@string Es la cadena a desencryptar
 *@key Es la llave para desencryptar
 */
function desencriptar($string, $key='V3+5.1sewerew.4c7/s+-s') {
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}


function formato_fecha($date,$format=NULL)
{
    if($format==NULL)
    {
         return date('d-m-Y', strtotime($date));
    }
        return date($format, strtotime($date));


}


function highlight($text, Request $request) {
    $words=$request->input("busqueda");

    preg_match_all('~\w+~', $words, $m);
    if(!$m)
        return $text;
    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
    return preg_replace($re, '<span class="highlight">$0</span>', $text);
}
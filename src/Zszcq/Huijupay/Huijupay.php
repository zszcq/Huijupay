<?php
namespace Zszcq\Huijupay;

class Huijupay{

	public function __construct()
	{

	}

	/**
	 * 生成签名
	 * @param $params
	 * @param $key
	 * @param string $encryptType
	 * @return string
	 */
	function hmacRequest($params, $key, $encryptType = "1")
	{
	    if ("1" == $encryptType) {
	        return md5(implode("", $params) . $key);
	    } else {
	        $private_key = openssl_pkey_get_private($key);
	        $params = implode("", $params);
	        openssl_sign($params, $sign, $private_key, OPENSSL_ALGO_MD5);
	        openssl_free_key($private_key);
	        $sign = base64_encode($sign);
	        return $sign;
	    }

	}

	/**
	 * POST请求
	 */
	function send_req($url, $params,$contentType=false)
	{

		if ($url == 'sendsms') {
			
			$url = 'https://www.joinpay.com/trade/fastpaySmsApi.action';
		}elseif ($url = 'pay') {
			$url = 'https://www.joinpay.com/trade/fastpayPayApi.action';
		}else{
			die('请输入正确的请求地址!');
		}

	    if (function_exists('curl_init')) { // curl方式
	        $oCurl = curl_init();
	        if (stripos($url, 'https://') !== FALSE) {
	            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
	            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
	        }
	        $string = $params;
	        if (is_array($params)) {
	            $aPOST = array();
	            foreach ($params as $key => $val) {
	                $aPOST[] = $key . '=' . urlencode($val);
	            }
	            $string = join('&', $aPOST);
	        }
	        curl_setopt($oCurl, CURLOPT_URL, $url);
	        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($oCurl, CURLOPT_POST, TRUE);
	        //$contentType json处理
	        if($contentType){
	            $headers = array(
	                "Content-type: application/json;charset='utf-8'",
	            );

	            curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($params));
	        }else{
	            curl_setopt($oCurl, CURLOPT_POSTFIELDS, $string);
	        }
	        $response = curl_exec($oCurl);
	        curl_close($oCurl);
	        return $response;
	    } elseif (function_exists('stream_context_create')) { // php5.3以上
	        $opts = array(
	            'http' => array(
	                'method' => 'POST',
	                'header' => 'Content-type: application/x-www-form-urlencoded',
	                'content' => http_build_query($params),
	            )
	        );
	        $_opts = stream_context_get_params(stream_context_get_default());
	        $context = stream_context_create(array_merge_recursive($_opts['options'], $opts));
	        return file_get_contents($url, false, $context);
	    } else {
	        return FALSE;
	    }
	} 
}









?>
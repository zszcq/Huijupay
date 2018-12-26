<?php
//汇聚支付 快捷-直接支付-短信接口demo
require_once './vendor/autoload.php';
use Zszcq\Huijupay\Huijupay;

$pay = new Huijupay();

//参数必须按如下顺序排列
$params = array();
$params['p0_Version']         = '2.0';                    	//版本号 必填
$params['p1_MerchantNo']      = '888000000000000';        	//商户编号 必填
$params['p2_MerchantName']    = '技术测试账号';			    //商户名称 必填
$params['p3_SubMerchantNo']   = '';					   	 	//子商户号 非必填
$params['p4_PayerId']         = '';					    	//商户身份标识 非必填
$params['q1_OrderNo']         = '';					    	//商品订单号 必填
$params['q2_Amount']          = sprintf("%.2f",'0.01');   	//订单金额 必填 带两位小数
$params['q3_Cur']             = 1; 					    	//交易币种 必填 1人民币
$params['q4_ProductName']     = ''; 						//商品名称 必填
$params['q5_OrderExpire']     = '';							//订单有效期 非必填
$params['q6_ReturnUrl'] 	  = '';							//页面通知地址 非必填
$params['q7_NotifyUrl'] 	  = 'http://';					//异步通知地址 必填
$params['q8_FrpCode'] 		  = 'FAST';						//银行编码 必填
$params['q9_Mp'] 			  = '';							//订单回传信息 非必填
$params['s1_PayerName']       = '';							//支付人姓名 必填
$params['s2_PayerCardType']   = '';							//支付人证件类型 必填 1身份证
$params['s3_PayerCardNo']     = '';							//支付人证件号 必填
$params['s4_PayerBankCardNo'] = '';							//支付人银行卡号 必填
$params['s5_BankCardExpire']  = '';					    	//信用卡有效期 非必填(如果为信用卡则必填)格式YYYY-MM 
$params['s6_CVV2']			  = '';							//信用卡CVV2 非必填(如果为信用卡则必填)
$params['s7_BankMobile'] 	  = '';							//银行预留手机号 必填
$params['s8_IsBindCard']      = '';							//绑卡标识 非必填
$params['t1_Rcms'] 			  = '';							//风险控制标识 非必填
$params['t2_ext']             = '';							//短信验证码 非必填
$params['t3_ext']             = '';							//预留字段 非必填

//验签方式 

//MD5验签
$hmac = $pay -> hmacRequest($params,'参数为商户秘钥');

//RSA验签
//$params['hmac'] -> hmacRequest($params,'参数为RSA秘钥文件',2);

$params['hmac'] = urlencode($hmac);

//第一个参数为'sendsms'代表请求短信接口,为'pay'代表请求支付接口
$res = $pay -> send_req('sendsms',$params);

//返回类型为json格式
var_dump($res);
?>
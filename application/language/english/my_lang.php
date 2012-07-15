<?php

$lang['Hello'] = 'hi my name is mumoo.';

$lang['hompage'] = 'OnlinePrinting/homepage';

$lang['header'] = 'OnlinePrinting/include/header';
$lang['includeheader'] = 'OnlinePrinting/include/headinclude';
$lang['footer'] = 'OnlinePrinting/include/footer';



$lang['registerSuccess'] = 'OnlinePrinting/register/RegisterSuccess';
$lang['registerconfirmpage'] = 'OnlinePrinting/register/confirmpage';
$lang['registerform'] = 'OnlinePrinting/register/registerform';



$lang['logindialog'] = 'testlogin';




$lang['productpage'] = 'OnlinePrinting/Product/productpage';
$lang['chooseproduct'] = 'OnlinePrinting/Product/Chooseproduct';

$lang['templatefileroot']='./asset/templatefile/';
$lang['uploadframe']='OnlinePrinting/frame/uploadframe';

$lang['orderpage']='OnlinePrinting/Orders/orderspage';
$lang['createorder'] = 'OnlinePrinting/Orders/CreateOrder';
$lang['confirmorder']='OnlinePrinting/Orders/ConfirmOrder';
$lang['ordersumary']='OnlinePrinting/Orders/OrderSumary';
$lang['viewOrderdetail']='OnlinePrinting/Orders/viewOrderdetail';

$lang['showpriceframe'] = 'OnlinePrinting/frame/showPriceframe';
$lang['showcartframe'] = 'OnlinePrinting/frame/showCartframe';
$lang['loginframe'] = 'OnlinePrinting/frame/loginframe';







$lang['sqlcalprice']='select pr.price as price, pr.qty as qty, pa.paper_name as papername, pa.gram as gram,tmp.tmp_name as tmpname,tmp.size as size ,tmp.`type` as`type`,tmp.url as filepath from price pr join paper pa  on pr.paperno=pa.paperno
 join template tmp  on pr.tempno=tmp.tempno where pr.paperno =? and pr.tempno=? and pr.qty=?';
//----------------------------Back-------------------------------//

$lang['baklogin'] ='Backend/login';
$lang['bakhome'] ='Backend/home';

$lang['Bakincludeheader'] ='Backend/include/headinclude';




?>

<?php
/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/4
 * Time: 上午11:28
 */

require_once "WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once "WxPay.JsApiPay.php";

class WeChatPayService{

    public static function QRCodePay( $product ){
        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->SetProduct_id($product['product_id']);
        $input->SetGoods_tag($product['goods_tag']);
        $input->SetBody($product['body']);
        $input->SetAttach($product['attach']);
        $input->SetTotal_fee($product['fee']);
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        dump($input);
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        dump($result);
        return "http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($url2);
    }

    public static function jsApiPay( $product ){
        //①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetGoods_tag($product['goods_tag']);
        $input->SetBody($product['body']);
        $input->SetAttach($product['attach']);
        $input->SetTotal_fee($product['fee']);

        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);

        $order = WxPayApi::unifiedOrder($input);
//        dump($order);
        $ret['order'] = $order;
        $ret['jsApiParameters'] = $tools->GetJsApiParameters($order);
        $ret['editAddress'] = $tools->GetEditAddressParameters();
        return $ret;
    }

}



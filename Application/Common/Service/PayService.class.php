<?php

/**
 * Created by PhpStorm.
 * User: lijian
 * Date: 16/6/4
 * Time: 上午10:56
 */

namespace Common\Service;

class PayService{

    /**
     * @return string
     */
    public static function QRCodePay(){
        Vendor('WeChatPay.WxPayService');

        $product['product_id'] = "123123123";
        $product['goods_tag'] = "日行一善";
        $product['body'] = "日行一善";
        $product['attach'] = "日行一善";
        $product['fee'] = "1";

        return \WeChatPayService::QRCode();
    }


}
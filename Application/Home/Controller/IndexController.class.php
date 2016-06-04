<?php
namespace Home\Controller;

use Common\Service\PayService;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        $qrCode = PayService::wxQRCodePay();
        dump($qrCode);
        $this->assign("qrcode", $qrCode);
        $this->display();
    }

    public function jsapi(){
        $result = PayService::wxJsApiPay();
        $this->assign("order", $result['order'] );
        $this->assign("jsApiParameters", $result['jsApiParameters']);
        $this->assign("editAddress", $result['editAddress']);
        $this->display();
    }

}
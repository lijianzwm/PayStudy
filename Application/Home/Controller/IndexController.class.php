<?php
namespace Home\Controller;

use Common\Service\PayService;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        $qrCode = PayService::QRCodePay();
        dump($qrCode);
        $this->assign("qrcode", $qrCode);
        $this->display();
    }
}
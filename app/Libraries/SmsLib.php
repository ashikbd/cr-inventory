<?php
namespace App\Libraries;

class SmsLib {
    private $url = "https://portal.adnsms.com/api/v1/secure/send-sms";
    private $api_key = "KEY-icu3r1aqxzsijalzd7i7ev9xrz25y5se";
    private $api_secret = "rzx9nj@pMqB@R0z5";
    private $request_type="SINGLE_SMS";
    private $message_type="UNICODE";
    private $number;
    private $text;
    public $response;
    private $campaign_title;

    private function send_sms(){
        $data = array(
            'api_key'=>$this->api_key,
            'api_secret'=>$this->api_secret,
            'request_type'=>$this->request_type,
            'message_type'=>$this->message_type,
            'mobile'=>$this->number,
            'message_body'=>$this->text
        );

        if($this->request_type == "GENERAL_CAMPAIGN"){
            $data['campaign_title'] = $this->campaign_title;
        }

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $smsresult = curl_exec($ch);
        $resp = json_decode($smsresult,true);
        $this->response = $resp['api_response_code'];
    }

    public function birthday_sms($mobile,$msg){

        $this->text = $msg;
        $this->number = $mobile;
        //$this->request_type = "GENERAL_CAMPAIGN";
        //$this->campaign_title = "Client Birthday";

        $this->send_sms();

        return $this->response;
    }
}
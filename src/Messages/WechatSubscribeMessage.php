<?php

namespace Ywmelo\TemplateMessage\Messages;

use EasyWeChat;
use Ywmelo\TemplateMessage\Exceptions\WechatSubscribeMessageException;

class WechatSubscribeMessage
{

    private $templateMessage;

    private $openId;

    private $templateId;

    private $page;

    private $data;

    /**
     * WechatTemplateMessage constructor.
     */
    public function __construct()
    {
        $this->templateMessage = EasyWeChat::miniProgram()->template_message;
    }

    /**
     * @return mixed
     * @throws WechatSubscribeMessageException
     */
//    public function send()
//    {
//        $result = $this->templateMessage->send($this->setMessage());
//        if ($result['errcode'] != 0) {
//            throw new WechatTemplateMessageException($result['errmsg'], $result['errcode']);
//        }
//
//        return $result;
//    }

    /**
     * @return array
     */
    public function setMessage()
    {
        return [
            'template_id' => $this->templateId,
            'page' => $this->page,
            'data' => $this->data,
        ];
    }

    /**
     * @param string $openId
     * @return $this
     */
    public function to($openId = '')
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * @param $templateId
     * @return $this
     */
    public function setTemplateId($templateId = '')
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * @param string $page
     * @return $this
     */
    public function setPage($page = '')
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data = [])
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'touser' => $this->openId,
            'template_id' => $this->templateId,
            'page' => $this->page,
            'data' => $this->data,
        ];
    }
}

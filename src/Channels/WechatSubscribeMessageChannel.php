<?php

namespace Ywmelo\TemplateMessage\Channels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Ywmelo\TemplateMessage\Exceptions\WechatSubscribeMessageException;

class WechatSubscribeMessageChannel
{
    /**
     * 发送指定的通知.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if ($notifiable instanceof Model) {
            $to = $notifiable->openid ?? $notifiable->routeNotificationForOpenid($notification);
        }

        $message = $notification->toWechatSubscribeMessage($notifiable)
            ->to($to);

        $result = \EasyWeChat::miniProgram()->subscribe_message->send($message->toArray());

        if ($result['errcode'] != 0) {
            throw new WechatSubscribeMessageException($result['errmsg'], $result['errcode']);
        }
    }
}

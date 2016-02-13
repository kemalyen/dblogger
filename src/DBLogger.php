<?php

namespace Gazatem\DBLogger;

use Gazatem\DBLogger\Model\Log as Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\Curl\Util;
use Illuminate\Support\Facades\Mail;

class DBLogger extends AbstractProcessingHandler
{

    private $httpConnection = null;

    protected function write(array $record)
    {
        $hasLevel = in_array($record['level_name'], config('dblogger.levels'));
        $hasChannel = in_array($record['message'], config('dblogger.channels'));

        $notifications = config('dblogger.notification');

        $send_notification = 0;
        foreach ($notifications as $key => $value) {
            if ($key === $record['message']) {
                $send_notification = in_array($record['level_name'], $value);
            }
        }

        if ($send_notification) {
            $messages = config('dblogger.messages');

            $data = ['record' => $record, 'action' => (isset($messages[$record['message']]) ? $messages[$record['message']] : $record['message'])];
            Mail::send("dblogger::notification", $data, function ($message) {
                $message->to(config('dblogger.mail_to'))->subject(config('dblogger.mail_subject'));
            });
        }

        if ($hasLevel && $hasChannel) {
            if (config('dblogger.service') === 'remote') {
                $this->post_remote($record);
            } else {
                Logger::create(
                    [
                        'message' => $record['message'],
                        'context' => json_encode($record['context']),
                        'level' => $record['level'],
                        'level_name' => $record['level_name'],
                    ]);
            }
        }
    }

    private function post_remote(array $record)
    {


        $date = $record['datetime'];

        $data = array('time' => $date->format('Y-m-d\TH:i:s.uO'));
        unset($record['datetime']);

        if (isset($record['context']['type'])) {
            $data['type'] = $record['context']['type'];
            unset($record['context']['type']);
        } else {
            $data['type'] = $record['channel'];
        }

        $data['data'] = $record['context'];
        $data['level'] = $record['level'];
        $data['level_name'] = $record['level_name'];
        $data['message'] = $record['message'];

        $postString = json_encode($data);
        $this->writeHttp($postString);
    }

    private function writeHttp($data)
    {
        if (!$this->httpConnection) {
            $this->connectHttp();
        }

        curl_setopt($this->httpConnection, CURLOPT_POSTFIELDS,  $data);
        curl_setopt($this->httpConnection, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ". config('dblogger.api_key'),
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );

        Util::execute($this->httpConnection, 5, false);
    }

    /**
     * Establish a connection to a http server
     */
    protected function connectHttp()
    {
        if (!extension_loaded('curl')) {
            throw new \LogicException('The curl extension is needed to use http URLs');
        }

        $this->httpConnection = curl_init(config('dblogger.remote_host'));

        if (!$this->httpConnection) {
            throw new \LogicException('Unable to connect to ' . config('dblogger.remote_host'));
        }

        curl_setopt($this->httpConnection, CURLOPT_POST, "POST");
        curl_setopt($this->httpConnection, CURLOPT_RETURNTRANSFER, true);
    }

}
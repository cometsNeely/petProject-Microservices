<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQRPCClientController extends Controller
{
    
    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;

    public function __construct()
    {

        $this->connection = new AMQPStreamConnection(
            'rabbitmq',
            5672,
            'guest',
            'guest'
        );

        $this->channel = $this->connection->channel();

        $this->channel->basic_qos(null, 1, false);
        $this->channel->exchange_declare('admin', 'direct', false, true, false);

        list($this->callback_queue, ,) = $this->channel->queue_declare(
            "",
            false,
            false,
            true,
            false
        );

        $this->channel->queue_declare('rpc_admin', false, true, false, false);
        $this->channel->queue_bind('rpc_admin', 'admin', 'is_admin'); 

        $this->channel->basic_consume(

            $this->callback_queue,
            '',
            false,
            true,
            false,
            false,
            array(
                $this,
                'onResponse'
            )

        );

    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {

            $this->response = $rep->body;

        }
    }

    public function call($msg)
    {

        $this->response = null;
        $this->corr_id = uniqid();

        $message = new AMQPMessage(
            $msg,
            array(

                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue

            )
        );

        $this->channel->basic_publish($message, 'admin', 'is_admin');

        while (!$this->response) {

            $this->channel->wait();

        }

        return $this->response;

    }

    public function subscribe(Request $request)
    {

        $response = $this->call('Request: ...');
        return response()->json(['response_message' => $this->response, 'value_abilities' => true]);

    }

}

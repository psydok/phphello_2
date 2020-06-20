<?php

namespace app\commands\ws;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Promise;
use Amp\Success;
use Amp\Websocket\Client;
use Amp\Websocket\Message;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Endpoint;
use app\modules\metric\models\Metric;
use Throwable;
use function Amp\call;

/**
 * Class wsHandler
 */
class wsHandler implements ClientHandler
{
    const ALLOWED_ORIGINS = [
        'http://192.168.99.102:1337',
        'http://192.168.99.102:8500',
        'http://0.0.0.0:1337',
    ];

    public function handleHandshake(Endpoint $endpoint, Request $request, Response $response): Promise
    {
        if (!\in_array($request->getHeader('origin'), self::ALLOWED_ORIGINS, true)) {
            return $endpoint->getErrorHandler()->handleError(403);
        }

        return new Success($response);
    }

    public function handleClient(Endpoint $endpoint, Client $client, Request $request, Response $response): Promise
    {
        return call(function () use ($endpoint, $client): \Generator {
            while ($message = yield $client->receive()) {
                assert($message instanceof Message);
                $msg = yield $message->buffer();
                $endpoint->broadcast(\sprintf(
                    '%d: %s',
                    $client->getId(),
                    $msg
                ));

                try {
                    $data = json_decode($msg);

                    $model = new Metric();
                    $model->name = $data->{'name'};
                    $model->field = $data->{'field'};
                    $model->value = $data->{'value'};
                    $model->date = date("Y-m-d H:i:s");
                    $model->save();
                } catch (Throwable $throwable) {
                }
            }
        });
    }
}
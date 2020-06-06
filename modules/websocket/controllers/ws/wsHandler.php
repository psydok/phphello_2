<?php
namespace app\modules\websocket\controllers\ws;

use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Server\Router;
use Amp\Http\Server\StaticContent\DocumentRoot;
use Amp\Log\ConsoleFormatter;
use Amp\Log\StreamHandler;
use Amp\Loop;
use Amp\Promise;
use Amp\Socket\Server as SocketServer;
use Amp\Success;
use Amp\Websocket\Client;
use Amp\Websocket\Message;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Endpoint;
use Amp\Websocket\Server\Websocket;
use Generator;
use Monolog\Logger;
use function Amp\ByteStream\getStdout;
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
        return call(function () use ($endpoint, $client): Generator {
            while ($message = yield $client->receive()) {
                assert($message instanceof Message);
                $endpoint->broadcast(\sprintf(
                    '%d: %s',
                    $client->getId(),
                    yield $message->buffer()
                ));
            }
        });
    }
}
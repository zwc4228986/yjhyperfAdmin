<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Exception\Handler;

use Hyperf\Context\Context;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Router\Dispatched;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class HttpExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger, protected FormatterInterface $formatter)
    {
    }

    /**
     * Handle the exception, and return the specified result.
     * @param HttpException $throwable
     */
    public function handle(Throwable $throwable, ResponseInterface $response)
    {

        $request = Context::get(ServerRequestInterface::class);
        $dispatched = $request->getAttribute(Dispatched::class);

        $this->logger->debug($this->formatter->format($throwable));

        $this->stopPropagation();

        return $response->withStatus($throwable->getStatusCode())->withBody(new SwooleStream($throwable->getMessage()));
    }

    /**
     * Determine if the current exception handler should handle the exception.
     *
     * @return bool If return true, then this exception handler will handle the exception,
     *              If return false, then delegate to next handler
     */
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof HttpException;
    }
}

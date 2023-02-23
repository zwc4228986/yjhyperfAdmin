<?php
/**
 * @Notes:【】
 * @Date: 2022-06-17 0:50
 */

namespace YjHyperfAdminPligin\Framework\Listener;

use Hyperf\DbConnection\Db;
use Hyperf\Event\Contract\ListenerInterface;

use Hyperf\Database\Events\QueryExecuted;
use Hyperf\Event\Annotation\Listener;

use Hyperf\Framework\Event\AfterWorkerStart;
use Hyperf\Framework\Event\BeforeServerStart;
use Hyperf\Framework\Event\BeforeWorkerStart;


#[Listener]
class WorkerStartListener implements ListenerInterface
{
    protected $providers = null;

    public function listen(): array
    {
        return [
            BeforeServerStart::class
        ];
    }

    /**
     * @param QueryExecuted $event
     */
    public function process(object $event): void
    {

        $this->init($event->serverName);

    }

    public function init($serverName)
    {
        if (is_null($this->providers)) {
            $this->providers = $this->registerProviders();
        }
        $this->runProviders($serverName);
    }

    private function runProviders($serverName)
    {
        foreach ($this->providers as $provider) {
            $provider->boot($serverName);
            //如何释放 new 出来的类
        }
    }

    private function registerProviders()
    {
        $providers = config('framework.providers');

        return new RewindableGenerator(function () use ($providers) {
            foreach ($providers as $abstract) {
                yield make($abstract);
            }
        }, count($providers));
    }

}
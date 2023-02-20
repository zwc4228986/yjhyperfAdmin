<?php
/**
 * @Notes:【】
 * @Date: 2023-02-18 12:17
 */

namespace YjHyperfAdminPligin\Framework\Builder;

use Hyperf\Database\Model\Builder;

use YjHyperfAdminPligin\Framework\Listener\ServiceProvider;

class BuilderProvider extends ServiceProvider
{
    public function boot($serverName)
    {
        dump('BuilderProvider');
        Builder::macro('yjRangeTime', function ($field, $types) {
            $now = \Carbon\Carbon::now();
            switch (['today' => 0, 'yesterday' => -1][$types] ?? $types) {
                case 'month':
                    $startTime = $now->clone()->startOfMonth();
                    $endTime = $now->endOfMonth();
                    break;
                case "last_month" :
                    $startTime = $now->subMonth()->clone()->startOfMonth();
                    $endTime = $now->endOfMonth();
                    break;
                case "year" :
                    $startTime = $now->clone()->startOfYear();
                    $endTime = $now->endOfYear();
                    break;
                case "last_year" :
                    $startTime = $now->subYear()->clone()->startOfYear();
                    $endTime = $now->endOfYear();
                    break;
                default:
                    $startTime = $now->subDays((int)$types)->clone()->startOfDay();
                    $endTime = $now->endOfDay();
            }
            return $this->whereBetween($field, [$startTime->timestamp, $endTime->timestamp]);
        });
    }
}
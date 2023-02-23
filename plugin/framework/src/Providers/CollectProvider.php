<?php

namespace YjHyperfAdminPligin\Framework\Providers;

use Hyperf\Utils\Arr;
use Hyperf\Utils\Collection;

class CollectProvider extends ServiceProvider
{
    public function boot($serverName)
    {
        Collection::macro('check', function ($fields, $value = null, $callback = true) {
            /** @var Collection $self */
            $self = $this;

            if (is_callable($value)) {
                $callback = $value;
                $value = null;
            }
            
            $fields = Arr::wrap($fields);

            $value = collect(is_null($value) ? [$value] : Arr::wrap($value));
            $fields = collect($fields);
            $fields->transform(function ($field) use ($self) {
                $val = $self->get($field);
                return $val;
            });

            if ($fields->filter(function ($val) use ($value, $self) {
                    return false === collect($value)->containsStrict($val);
                })->count() == count($fields)) {
                return $callback(...$fields->toArray());
            }

            return false;
        });
    }
}
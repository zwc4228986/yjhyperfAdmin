<?php

namespace YjHyperfAdminPligin\Form\Column;

use Hyperf\Utils\Str;

use YjHyperfAdminPligin\Form\Column\Core\Types\BaseTypes;
use YjHyperfAdminPligin\Form\Column\Core\Types\SwitchTypes;
use YjHyperfAdminPligin\Form\Column\Core\Types\TxtTypes;

/**
 * @method static TxtTypes txt
 * @method static BaseTypes image
 * @method static BaseTypes slot
 * @method static SwitchTypes switch
 */
class Column
{

    protected $rules = [];

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }


    public function setRules($rules)
    {
        if (is_array($rules)) {
            foreach ($rules as $item) {
                $this->setRules($item);
            }
        } else {
            $this->rules[] = $rules;
        }
        return $this;
    }

    public static function create()
    {
        return new self();
    }

    public function toArray()
    {
        return collect($this->rules)->transform(function ($rule) {
            return $rule->toArray();
        });
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return BaseTypes
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $name = Str::ucfirst($name);
        $name = "\YjHyperfAdminPligin\Form\Column\Core\Types\\{$name}Types";
        return new $name();
    }
}
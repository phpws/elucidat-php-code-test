<?php

namespace App\Data\Collections;

use App\Data\Entities\RuleEntity;
use App\System\Collection;

/**
 * Class RuleEntityCollection
 *
 * Used to hold and work with a collection of RuleEntities.
 *
 * @package App\Data\Collections
 */
class RuleEntityCollection extends Collection
{
    /**
     * RuleEntityCollection constructor.
     * @param array $ruleEntities
     */
    public function __construct(array $ruleEntities)
    {
        $this->setData($ruleEntities);
    }

    /**
     * @return bool
     */
    public function hasNoRuleSpecified(): bool
    {
        if (!$this->data()) {
            return true;
        }
        foreach ($this->data() as $rule) {
            if ($rule->getCondition() == RuleEntity::CONDITION_NONE) {
                return true;
            }
        }
        return false;
    }
}
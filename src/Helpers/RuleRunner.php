<?php

namespace App\Helpers;

use App\Data\Entities\ItemEntity;
use App\Data\Entities\RuleEntity;

class RuleRunner
{
    /**
     * @var ItemEntity
     */
    private ItemEntity $item;

    /**
     * RuleRunner constructor.
     * @param ItemEntity $item
     */
    public function __construct(ItemEntity $item)
    {
        $this->item = $item;
    }

    /**
     * @return void
     */
    public function runRules()
    {
        $rules = $this->item->getRules();

        if ($rules->hasNoRuleSpecified()) {
            // Don't do anything, as specifically configured to run no rules.
            // for example the 'Sulfuras Items'
            return;
        }

        /**
         * @var RuleEntity $rule
         */
        foreach ($this->item->getRules()->data() as $rule) {
            $this->updateQualityOnRule($rule);
        }
        $this->item->updateSellIn();
    }

    /**
     * @param RuleEntity $rule
     */
    private function updateQualityOnRule(RuleEntity $rule)
    {
        $item = $this->item;
        $qualityChangeRate = $rule->getQualityChangeRate();

        switch ($rule->getCondition()) {
            case RuleEntity::CONDITION_BETWEEN:
                if ($item->getSellIn() >= 0)
                {
                    if ($item->getSellIn() <= $rule->getSellInCriteriaLower()
                        && $item->getSellIn() >= $rule->getSellInCriteriaUpper()
                    ) {
                        $item->updateQuality($qualityChangeRate);
                    }
                } else if (
                    $item->getSellIn() >= $rule->getSellInCriteriaLower()
                    && $item->getSellIn() <= $rule->getSellInCriteriaUpper()
                ) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_EQUAL_TO:
                if ($item->getSellIn() == 0) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_GREATER_THAN:
                if ($item->getSellIn() > $rule->getSellInCriteriaLower()) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_GREATER_THAN_EQUAL_TO:
                if ($item->getSellIn() >= $rule->getSellInCriteriaLower()) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_LESS_THAN:
                if ($item->getSellIn() < $rule->getSellInCriteriaLower()) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_LESS_THAN_EQUAL_TO:
                if ($item->getSellIn() <= $rule->getSellInCriteriaLower()) {
                    $item->updateQuality($qualityChangeRate);
                }
                break;
            case RuleEntity::CONDITION_END_ON_SELLIN_DAY:
                if ($item->getSellIn() <= $rule->getSellInCriteriaLower()) {
                    $item->setQuality($rule->getQualityChangeRate());
                }
            case RuleEntity::CONDITION_NONE:
            default:
        }

        // Don't let the quality value go above RuleEntity::MAX_QUALITY
        if ($item->getQuality() >= RuleEntity::MAX_QUALITY) {
            $item->setQuality(RuleEntity::MAX_QUALITY);
        }
    }
}
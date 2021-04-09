<?php

namespace App\Data\Entities;

class RuleEntity
{
    const MAX_QUALITY = 50;

    const CONDITION_GREATER_THAN = 'greaterThan';
    const CONDITION_GREATER_THAN_EQUAL_TO = 'greaterThanEqualTo';
    const CONDITION_LESS_THAN = 'lessThan';
    const CONDITION_LESS_THAN_EQUAL_TO = 'lessThanEqualTo';
    const CONDITION_EQUAL_TO = 'equalTo';
    const CONDITION_BETWEEN = 'between';
    const CONDITION_END_ON_SELLIN_DAY = 'endOnSellInDay';
    const CONDITION_NONE = 'none';

    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    private int $sellInCriteria;

    /**
     * @var int|null
     */
    private ?int $sellInCriteriaRange;

    /**
     * @var int
     */
    private int $qualityChangeRate;

    /**
     * note: Enum values could anything I opted for strings to make it more readable.
     *
     * @var string - Enum from DB possible values of [
     *     'lessThan',
     *     'equalTo',
     *     'greaterThan',
     *     'lessThenEqualTo',
     *     'greaterThanEqualTo',
     *     'none',
     *     'endOnSellInDay'
     * ]
     */
    private string $condition;

    /**
     * RuleEntity constructor.
     * @param int $id - This would be populated when getting the record from a DB table, I have just included for completeness although I am not using it for anything.
     * @param int $sellInCriteria
     * @param int $qualityChangeRate
     * @param string $condition
     * @param int|null $sellInCriteriaRange
     */
    public function __construct(
        int $id, int $sellInCriteria, int $qualityChangeRate, string $condition,  int $sellInCriteriaRange = null
    ) {
        $this->id = $id;
        $this->sellInCriteria = $sellInCriteria;
        $this->qualityChangeRate = $qualityChangeRate;
        $this->condition = $condition;
        $this->sellInCriteriaRange = $sellInCriteriaRange;
    }

    /**
     * @return int
     */
    public function getSellInCriteriaLower(): int
    {
        return $this->sellInCriteria;
    }

    /**
     * @return int|null
     */
    public function getSellInCriteriaUpper(): ?int
    {
        return $this->sellInCriteriaRange;
    }

    /**
     * @return int
     */
    public function getQualityChangeRate(): int
    {
        return $this->qualityChangeRate;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }
}
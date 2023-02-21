<?php
/**
 * @Notes:【】
 * @Date: 2023-02-20 23:05
 */

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @method static string getMessage(int $code)
 */
#[Constants]
class UserIntegral extends AbstractConstants
{
    /**
     * @Message("每日签到")
     */
    const SIGN = 'sign';

    /**
     * @Message("购买商品")
     */
    const BUY_PRODUCT = 'buy_product';

}
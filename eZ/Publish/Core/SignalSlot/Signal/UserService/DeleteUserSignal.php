<?php
/**
 * DeleteUserSignal class
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Publish\Core\SignalSlot\Signal\UserService;

use eZ\Publish\Core\SignalSlot\Signal;

/**
 * DeleteUserSignal class
 * @package eZ\Publish\Core\SignalSlot\Signal\UserService
 */
class DeleteUserSignal extends Signal
{
    /**
     * UserId
     *
     * @var mixed
     */
    public $userId;
}

<?php
/**
 * File containing the AbstractFieldTypeParser class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\Parser;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\AbstractParser;

/**
 * Abstract parser class that field type parsers need to extend in order
 * to receive NodeBuilder at Node just under ezpublish.system.<siteaccess>.fieldtypes
 */
abstract class AbstractFieldTypeParser extends AbstractParser
{
}

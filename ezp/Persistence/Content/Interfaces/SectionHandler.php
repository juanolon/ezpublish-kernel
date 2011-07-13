<?php
/**
 * File containing the SectionHandler interface
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package ezp
 * @subpackage persistence_content
 */

namespace ezp\Persistence\Content\Interfaces;

/**
 * @package ezp
 * @subpackage persistence_content
 */
interface SectionHandler
{
    /**
     * Creat a new section
     *
     * @param string $name
     * @param string $identifier
     * @return \ezp\Persistence\Content\Section
     */
    public function create( $name, $identifier );

    /**
     * Update name and identifier of a section
     *
     * @param mixed $id
     * @param string $name
     * @param string $identifier
     */
    public function update( $id, $name, $identifier );

    /**
     * Get section data
     *
     * @param mixed $id
     * @return \ezp\Persistence\Content\Section|null
     */
    public function load( $id );

    /**
     * Delete a section
     *
     * Might throw an exception if the section is still associated with some
     * content objects. Make sure that no content objects are associated with
     * the section any more *before* calling this method.
     *
     * @param mixed $id
     */
    public function delete( $id );

    /**
     * Assign section to single content object
     *
     * @param mixed $sectionId
     * @param mixed $contentId
     */
    public function assign( $sectionId, $contentId );
}
?>

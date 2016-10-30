<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Defines backup_googledrive_activity_task class
 *
 * @package   mod_googledrive
 * @category  backup
 * @copyright 2016 Nadav Kavalerchik <nadavkav@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/mod/googledrive/backup/moodle2/backup_googledrive_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the googledrive instance
 *
 * @package   mod_googledrive
 * @category  backup
 * @copyright 2016 Nadav Kavalerchik <nadavkav@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_googledrive_activity_task extends backup_activity_task {

    /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines a backup step to store the instance data in the googledrive.xml file
     */
    protected function define_my_steps() {
        $this->add_step(new backup_googledrive_activity_structure_step('googledrive_structure', 'googledrive.xml'));
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, '/');

        // Link to the list of googledrives.
        $search = '/('.$base.'\/mod\/googledrive\/index.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@NEWMODULEINDEX*$2@$', $content);

        // Link to googledrive view by moduleid.
        $search = '/('.$base.'\/mod\/googledrive\/view.php\?id\=)([0-9]+)/';
        $content = preg_replace($search, '$@NEWMODULEVIEWBYID*$2@$', $content);

        return $content;
    }
}

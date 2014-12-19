<?php

/**
 * Authentication and update user profile from web service helper block.
 *
 * @package    block
 * @subpackage vsdfa
 * @copyright  2014 Andrew "Kama" (kamasutra12@yandex.ru) 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_vsdfa extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_vsdfa');
    }

    function applicable_formats() {
        return array('site' => true);
    }

    function get_content () {
      global $USER, $CFG;
      $this->content = new StdClass();
      $this->content->text = '';
      $config = get_config('auth/vsdfa');

      //if ($USER->auth != 'vsdfa') {
          if (!isloggedin() or isguestuser()) {
          //Guests
            if (!isset($config->createtokenurl) or empty($config->createtokenurl)) { 
              $this->content->text = get_string('misconfigured', 'block_vsdfa');
            } else {
              $this->content->text .= '<a href="'.$config->createtokenurl.'" class="btn btn-primary">'.get_string('login', 'block_vsdfa').'</a>';
            }
          } elseif (isloggedin() and !is_siteadmin() and $USER->auth != 'vsdfa') {
          //Not converted AND not admin
            redirect($CFG->wwwroot.'/blocks/vsdfa/convert.php');
          } elseif (isloggedin() and $USER->auth == 'vsdfa') {
            // Logged in vsdfa user. Maybe I place some text here . . .
          } elseif (is_siteadmin()) {
            $this->content->text = get_string('youareadmin', 'block_vsdfa');
            $this->content->text .= '<a href="'.$CFG->wwwroot.'/blocks/vsdfa/convert.php" class="btn btn-primary">'.get_string('upgradeyourprofile', 'block_vsdfa').'</a>';
          }
      //}
      return $this->content;
    }
}



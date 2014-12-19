<?php

/**
 * Authentication and update user profile from web service helper block.
 *
 * @package    block
 * @subpackage vsdfa
 * @copyright  2014 Andrew "Kama" (kamasutra12@yandex.ru) 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$PAGE->set_url('/blocks/vsdfa/convert.php');
$PAGE->set_context(context_system::instance());

require_login();
if ($USER->auth == 'vsdfa') redirect($CFG->wwwroot);

$config = get_config('auth/vsdfa');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('heading', 'block_vsdfa'));

echo get_string('converthelp', 'block_vsdfa', array('l' => $config->registerurl));

$updurl = strtr($config->upgradeurl, array(':id' => $USER->idnumber));
echo '<a href="'.$updurl.'" class="btn btn-large btn-success">'.get_string('upgradeyourprofile', 'block_vsdfa').'</a>';

echo $OUTPUT->footer();
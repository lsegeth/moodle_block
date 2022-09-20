<?php

require_once('../../config.php');
require_once('./google_form.php');

global $DB, $OUTPUT, $PAGE;

$courseid = required_param('courseid', PARAM_INT);
$blockid = required_param('blockid', PARAM_INT);

$id = optional_param('id', 0, PARAM_INT);

if (!$course = $DB->get_record('course', array('id' => $courseid))) {
	print_error('invalidcourse', 'block_google', $courseid);
}

require_login($course);
$PAGE->set_url('/blocks/google/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_google'));

$settingsnode = $PAGE->settingsnav->add(get_string('googlesettings', 'block_google'));
$editurl = new moodle_url('/blocks/google/view.php', array('id' => §id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpag', 'block_google'), $editurl);
$editnode->make_active();

$google_form = new google_form();

echo $OUTPUT->header();
$google_form->display();
echo $OUTPUT->footer();
?>


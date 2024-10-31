<?php

/*
 * Plugin Name: Quform Max Form Submissions
 * Plugin URI: https://wordpress.org/plugins/quform-max-form-submissions/
 * Description: This extension allows you to specify a maximal number of form submissions for <a href="http://codecanyon.net/item/quform-wordpress-form-builder/706149?ref=scrobbleme" target="_blank">Quform</a> forms.
 * Version: 1.0.1
 * Author: MOEWE
 * Author URI: http://www.moewe.io/
 * Text Domain: quform-max-form-submissions
 */


class Quform_Max_Form_Submissions {

    private static $MAX_SUBMISSIONS_FIELD_NAME = 'max_number_of_submissions';

    function __construct() {
        add_action('iphorm_post_process', array($this, 'disable_form_if_limit_reached'), 10, 1);
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));

        add_shortcode('iphorm_remaining_entries', array($this, 'iphorm_remaining_entries'));
        add_shortcode('quform_remaining_entries', array($this, 'iphorm_remaining_entries'));

        add_shortcode('iphorm_disabled_form', array($this, 'iphorm_disabled_form'));
        add_shortcode('quform_disabled_form', array($this, 'iphorm_disabled_form'));

    }

    function load_plugin_textdomain() {
        load_plugin_textdomain('quform-max-form-submissions', false, basename(dirname(__FILE__)) . '/languages/');
    }

    /**
     * @param $form iPhorm
     */
    function disable_form_if_limit_reached($form) {
        $max_number_of_submissions = $this->get_max_submissions($form);
        if ($max_number_of_submissions <= 0) {
            return;
        }
        require_once IPHORM_ADMIN_DIR . '/admin.php';
        if (iphorm_get_form_entry_count($form->getId()) >= $max_number_of_submissions) {
            iphorm_deactivate_forms(array($form->getId()));
        }
    }

    /**
     * @param $atts array Attributes containing the form as id.
     * @return int|string The number of max entries for the given form.
     */
    function iphorm_remaining_entries($atts) {
        if (!function_exists('iphorm_form_exists')) {
            return '<p>' . __('<a href="http://codecanyon.net/item/quform-wordpress-form-builder/706149?ref=scrobbleme" target="_blank">Quform</a> must be installed and activated to use this shortcode.', 'quform-max-form-submissions') . '</p>';
        }

        $atts = shortcode_atts(
            array(
                'id' => -1,
            ), $atts);

        if (!iphorm_form_exists($atts['id'])) {
            return '<p>' . __('Please select a valid Quform', 'quform-max-form-submissions') . '</p>';
        }

        $form = iphorm_get_form(intval($atts['id']));
        $max_number_of_submissions = $this->get_max_submissions($form);
        if ($max_number_of_submissions <= 0) {
            return __('&infin;', 'quform-max-form-submissions');
        }
        require_once IPHORM_ADMIN_DIR . '/admin.php';
        return max($max_number_of_submissions - iphorm_get_form_entry_count($form->getId()), 0);
    }

    /**
     * @param $atts array Attributes containing the form as id.
     * @param $cont string The content will be shown, if the form is disabled.
     * @return string The number of max entries for the given form.
     */
    function iphorm_disabled_form($atts, $content = null) {
        if (!function_exists('iphorm_form_exists')) {
            return '<p>' . __('<a href="http://codecanyon.net/item/quform-wordpress-form-builder/706149?ref=scrobbleme" target="_blank">Quform</a> must be installed and activated to use this shortcode.', 'quform-max-form-submissions') . '</p>';
        }

        $atts = shortcode_atts(
            array(
                'id' => -1,
            ), $atts);

        if (!iphorm_form_exists($atts['id'])) {
            return '<p>' . __('Please select a valid Quform', 'quform-max-form-submissions') . '</p>';
        }

        if ($content == null) {
            $content = __('The form is disabled', 'quform-max-form-submissions');
        }
        $form = iphorm_get_form(intval($atts['id']));
        if ($form->getActive()) {
            return '';
        }
        return $content;
    }

    /**
     * @param $form iPhorm
     * @return int The max number of submissions or -1 if infinite.
     */
    private function get_max_submissions($form) {
        /** @var iPhorm_Element $element */
        foreach ($form->getElements() as $element) {
            if ($element->getLabel() == Quform_Max_Form_Submissions::$MAX_SUBMISSIONS_FIELD_NAME) {
                return intval($element->getDefaultValue());
            }
        }
        return -1;
    }
}

$quform_Max_Form_Submissions = new Quform_Max_Form_Submissions();


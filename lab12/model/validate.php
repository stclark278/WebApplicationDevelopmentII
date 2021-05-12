<?php

class Validate
{
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value, $required = true, $min = 1, $max = 255) {

        // Get Field object
        $field = $this->fields->getField($name);
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('This field is required. Please enter an appropriate value.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('The entry did not meet the minimum length requirements for the field.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('The entry exceeds the maximum number of characters allowed for the field.');
        } else {
            $field->clearErrorMessage();
        }
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message, $required = true) {
        // Get Field object
        $field = $this->fields->getField($name);
        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ($match != 1) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }
    // Validate a field as an email address
    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Use filter_var method to validate the email address
        $email = filter_var($value, FILTER_VALIDATE_EMAIL);

        // If email address is not valid, set error message and exit
        if ($email === false) {
            $field->setErrorMessage("Please enter a valid email address");
        } else {
            $field->clearErrorMessage();
        }
    }
    // Validate a dropdown for none default answers
    public function dropdown($name, $value, $message, $required = true) {
        $field = $this->fields->getField($name);
        // if the field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }
        // check required and set errors if empty
        if ($required && empty($value)) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }
}
<?php
class Validate
{
    private $fields;

    public function __construct()
    {
        $this->fields = new Fields();
    }

    public function getFields()
    {
        return $this->fields;
    }


    public function text(
        $name,
        $value,
        $required = true,
        $min = 1,
        $max = 255
    ) {

        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value)) {
            $field->setErrorMessage('Không được để trống');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Quá ngắn');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Quá dài');
        } else {
            $field->clearErrorMessage();
        }
    }

    // Validate a field with a generic pattern
    public function pattern(
        $name,
        $value,
        $pattern,
        $message,
        $required = true
    ) {

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
    // ----------------------------------------------------------------------------------------------------------

    public function phone($name, $value, $required = false)
    {
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        
        $pattern = '/^\d{10}$/';
        $message = 'Số điện thoại không hợp lệ.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }
    // ----------------------------------------------------------------------------------------------------------

    public function email($name, $value, $required = true)
    {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        $local = $parts[0];
        $domain = $parts[1];


        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc  = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern(
            $name,
            $local,
            $localPattern,
            'Email không hợp lệ..'
        );
        if ($field->hasError()) {
            return;
        }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern(
            $name,
            $domain,
            $domainPattern,
            'Email không hợp lệ.'
        );
    }
    // ----------------------------------------------------------------------------------------------------------

    public function number(
        $name,
        $value,
        $required = true,
        $min = 1,
        $max = 10000
    ) {

        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value) || !is_numeric($value) || $value < $min || $value > $max) {
            $field->setErrorMessage('Phải lớn hơn ' . $min . ' và nhỏ hơn ' . $max);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function image($name, $value, $required = true)
    {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value)) {
            $field->setErrorMessage('Không được để trống');
        } elseif($value != null) {
            $parts = explode('.', $value);
            $after = $parts[1];
            if ($after != 'jpg' &&  $after != 'jpeg' && $after != 'png' && $after != 'gif') {
                $field->setErrorMessage('Ảnh không đúng định dạng');
            } else {
                $field->clearErrorMessage();
            }
        }
    }
}

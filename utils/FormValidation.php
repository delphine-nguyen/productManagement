<?php

class FormValidation
{
    public static function validate(array $fields, array $form): bool
    {
        foreach ($fields as $field) {
            if (!isset($form[$field]) || empty($form[$field])) {
                return false;
            }
        }
        return true;
    }

    public static function cleanData(string $data): string
    {
        return htmlspecialchars($data);
    }
}

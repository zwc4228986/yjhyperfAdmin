<?php

if (!function_exists('formToData')) {
    function formToData($form): array
    {

        $rule = $form->formRule();
        $action = $form->getAction();
        $method = $form->getMethod();
        $title = $form->getTitle();
        $config = (object)$form->formConfig();
        $class = '';
        return compact('rule', 'action', 'method', 'title', 'config', 'class');
    }
}
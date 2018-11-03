<?php

$types = [];
foreach ($msgphp['domains'] as $domain) {
    foreach (glob($domain['path'].'/Infra/Doctrine/{**/*,*}Type.php', \GLOB_BRACE) as $file) {
        $class = 'MsgPhp\\'.str_replace('/', '\\', substr($file, 4, -4));
        $types[$domain['package']->name][$class::NAME] = $class;
    }

    if (isset($types[$domain['package']->name])) {
        ksort($types[$domain['package']->name]);
    }
}

$template = <<<'MD'
{% for package, info in types %}
## `{{ package }}`

Type name | Type class
--- | ---
{% for name, class in info %}
`{{ name }}` | `{{ class }}`
{% endfor %}

{% endfor %}
MD;

return [$template, 'types' => $types];

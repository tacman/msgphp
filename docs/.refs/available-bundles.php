<?php

$template = <<<'MD'
{% for bundle in msgphp.bundles %}
- `{{ bundle.package.name }}`: {{ bundle.package.description }}
{% endfor %}
MD;

return [$template];

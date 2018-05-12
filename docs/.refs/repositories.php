<?php

$template = <<<'MD'
{% for domain in msgphp.domains if domain.repositories %}
## `{{ domain.package.name }}`

{% for repository in domain.repositories %}
- `{{ repository }}`
{% endfor %}

{% endfor %}
MD;

return [$template];

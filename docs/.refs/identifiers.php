<?php

$template = <<<'MD'
{% for domain in msgphp.domains if domain.identifiers %}
## `{{ domain.package.name }}`

{% for identifier in domain.identifiers %}
### `{{ identifier.class }}`

Primitive type | Implementation
--- | ---
{% if identifier.scalar %}
Scalar | `{{ identifier.scalar }}`
{% endif %}
{% if identifier.uuid %}
UUID | `{{ identifier.uuid }}`
{% endif %}

{% endfor %}
{% endfor %}
MD;

return [$template];

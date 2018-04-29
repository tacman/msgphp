<?php

$template = <<<'MD'
{% for domain in msgphp.domains %}
## `{{ domain.package.name }}`

{% if domain.entities %}
### Entities

Class | Abstract
--- | ---
{% for entity in domain.entities %}
`{{ entity.class }}` | {{ entity.abstract ? '✔' : '✗' }}
{% endfor %}

{% endif %}
### Entity Fields

{% for field in domain.entity_fields %}
- `{{ field }}`
{% else %}
- No fields available
{% endfor %}

### Entity Features

{% for feature in domain.entity_features %}
- `{{ feature }}`
{% else %}
- No features available
{% endfor %}

{% endfor %}
MD;

return [$template];

<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR2' => true,
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PHP71Migration' => true,
    '@PHP71Migration:risky' => true,
    '@PHPUnit75Migration:risky' => true,
    'array_syntax' => ['syntax' => 'short'],
    'combine_consecutive_unsets' => true,
    'comment_to_phpdoc' => true,
    'compact_nullable_typehint' => true,
    'escape_implicit_backslashes' => true,
    'explicit_indirect_variable' => true,
    'explicit_string_variable' => true,
    'final_internal_class' => true,
    'fully_qualified_strict_types' => true,
    'header_comment' => ['header' => ''],
    'heredoc_to_nowdoc' => true,
    'list_syntax' => ['syntax' => 'short'],
    'logical_operators' => true,
    'multiline_comment_opening_closing' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
    'no_alternative_syntax' => true,
    'no_binary_string' => true,
    'no_null_property_initialization' => true,
    'no_short_echo_tag' => true,
    'no_unreachable_default_argument_value' => true,
    'no_superfluous_phpdoc_tags' => ['allow_mixed' => true],
    'no_unset_on_property' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'php_unit_method_casing' => true,
    'php_unit_set_up_tear_down_visibility' => true,
    'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_inline_tag' => false,
    'phpdoc_order' => true,
    'phpdoc_to_comment' => false,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'simple_to_complex_string_variable' => true,
    'static_lambda' => true,
    'strict_comparison' => true,
    'strict_param' => true,
    'string_line_ending' => true,
];

return Config::create()
    ->setUsingCache(true)
    ->setCacheFile(__DIR__.'/var/php-cs-fixer.cache')
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setFinder(Finder::create()
        ->in([
            __DIR__.'/src',
            __DIR__.'/tests',
        ])
        ->append([__FILE__])
        ->exclude([
            'UserBundle/Resources/skeleton',
        ])
    )
;

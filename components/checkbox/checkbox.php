<?php

// Fix PhpStorm inspection on undefined variable.
if ( empty( $args ) ) {
	$args = [];
}

$defaults = [
	'label'         => '',
	'checked'       => false,
	'disabled'      => false,
	'custom_class'  => '',
    'id'            => '',
    'name'          => '',
    'value'         => '',
];

// Fill args with defaults to avoid errors.
$args = bi_parse_args( $args, $defaults );

// Unpack arguments to variables for better readability.
// Should be in the same order as the keys in `$defaults` array.
[
	'label'         => $label,
	'checked'       => $checked,
	'disabled'      => $disabled,
	'custom_class'  => $custom_class,
	'id'            => $id,
	'name'          => $name,
	'value'         => $value,
] = $args;

// Validate and sanitize variables.

// Collect CSS classes
$classes = [
	'bi-checkbox',
];

// Apply custom CSS class
if ( $custom_class ) {
	$classes[] = $custom_class;
}

$attrs = [
    'type' => 'checkbox',
];

if ($checked) {
    $attrs['checked'] = '';
}

if ($disabled) {
    $attrs['disabled'] = '';
}

if ($id) {
    $attrs['id'] = $id;
}

if ($name) {
    $attrs['name'] = $name;
}

if ($value) {
    $attrs['value'] = $value;
}


// Output template.
?>

<label
	<?php the_class_attr( $classes ); ?>
>
    <?php if ($label): ?>
        <span class="bi-checkbox__label">
            <?= esc_html( $label ); ?>
        </span>
    <?php endif; ?>

    <input
	    <?php the_attrs( $attrs ); ?>
    >
    <span class="bi-checkbox__switch"></span>
</label>

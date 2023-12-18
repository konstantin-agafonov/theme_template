<?php

// Fix PhpStorm inspection on undefined variable.
if ( empty( $args ) ) {
	$args = [];
}

$defaults = [
	'label'         => [
        'text'          => '',
        'color'         => 'lightGrey',
        'color_checked' => 'paleGrey',
    ],
	'checked'       => false,
	'disabled'      => false,
	'custom_class'  => '',
    'id'            => '',
    'name'          => '',
    'value'         => '',
    'data_attrs'    => [
        [
	        'name'      => '',
	        'has_value' => true,
	        'value'     => '',
        ],
    ],
    'required'      => false,
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
	'data_attrs'    => $data_attrs,
	'required'      => $required,
] = $args;

// Validate and sanitize variables.

// Collect CSS classes
$classes = [
	'bi-checkbox-small',
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
    $attrs['disabled'] = 'true';
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

if ($required) {
    $attrs['required'] = 'true';
}

$the_data_attr_settings = [];
if ( !empty( $data_attrs ) ) {
	foreach ( $data_attrs as $data_attr ) {
        $the_data_attr_settings[ $data_attr['name'] ] = $data_attr['has_value'] ? $data_attr['value'] : '';
    }
}

// Output template.
?>

<label <?php the_class_attr( $classes ); ?>>
    <input
        <?php the_attrs( $attrs ); ?>
        <?php bi_the_data_attr( $the_data_attr_settings ); ?>
    >
    <span class="bi-checkbox-small__switch"></span>

    <?php if ($label['text']): ?>
        <span
                class="bi-checkbox-small__label
                    <?= match( $label['color'] ) {
                        'lightGrey' => 'bi-checkbox-small__label--light-grey',
                        'paleGrey'  => 'bi-checkbox-small__label--pale-grey',
                        'grey'      => 'bi-checkbox-small__label--grey',
                        'white'     => 'bi-checkbox-small__label--white',
                        default     => '',
                    }; ?>
                    <?= match( $label['color_checked'] ) {
    	                'lightGrey' => 'bi-checkbox-small__label--checked-light-grey',
                        'paleGrey'  => 'bi-checkbox-small__label--checked-pale-grey',
                        'grey'      => 'bi-checkbox-small__label--checked-grey',
                        'white'     => 'bi-checkbox-small__label--checked-white',
                        default     => '',
                    }; ?>
                "
        >
            <?= esc_html( $label['text'] ); ?>
        </span>
    <?php endif; ?>
</label>

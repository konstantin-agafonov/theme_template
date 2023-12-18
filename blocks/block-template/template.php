<?php
/**
 * A block template to serve as a boilerplate for other block templates.
 */

// Fix PhpStorm inspection on undefined variable.
if ( empty( $block ) ) {
	$block = [];
}
if ( empty( $content ) ) {
    $content = '';
}
if ( empty( $is_preview ) ) {
    $is_preview = false;
}
if ( empty( $post_id ) ) {
    $post_id = 0;
}

// Array of default field values for block
// Used to always define all possible arguments even if not all of them were passed
// This is needed later for the arguments unpacking.
$defaults = [
	// Simple string argument.
	'string'          => '',
	// Boolean argument.
	'boolean'         => false,
	// Images should always be passed as an ID of an attachment.
	'image'           => 0,
	// Default parameters for an array.
	'array'           => [
		'key1'               => 'value1',
		'key2'               => 5,
		// Nested arrays are also supported.
		'array_inside_array' => [
			'key1' => 'value1',
			'key2' => 5,
		],
	],
	// Default parameters for an array of arrays. For example, repeater field
	'array_of_arrays' => [
		// Default parameters for a row of an array of arrays.
		[
			'key1' => 'value1',
			'key2' => 5,
		],
	],
	'custom_class'    => '',
];

$block_fields = get_fields() ?: [];

// Fill args with defaults to avoid errors.
$block_fields = bi_parse_args( $block_fields, $defaults );

// Unpack arguments to variables for better readability.
// Should be in the same order as the keys in `$defaults` array.
[
	'string'          => $string,
	'boolean'         => $boolean,
	'image'           => $image,
	'array'           => $array,
	'array_of_arrays' => $array_of_arrays,
	'custom_class'    => $custom_class,
] = $block_fields;

$editor_custom_classes  = empty($block['className']) ? '' : $block['className'];
$editor_html_id         = empty($block['anchor']) ? '' : $block['anchor'];

// Validate and sanitize variables.

// Do not output template part if one of the required parameters is not set.
/*if ( ! $string ) {
	return;
}*/

// If we have image parameters, we can ensure we pass an ID of an attachment to the template,
//  no matter if ACF returns an ID of an attachment or its object.
// If ACF returns an image URL, this function won't handle this case -
//  we then need to change field output format in field group settings.
$image = bi_get_acf_field_image_id( $image );

// Collect CSS classes
$classes = [
	'example-class',
];

// Apply custom CSS class
if ( $custom_class ) {
	$classes[] = $custom_class;
}

if ( $editor_custom_classes ) {
	$classes[] = $editor_custom_classes;
}

// Output template.
?>
<div
    <?php if ( $editor_html_id ): ?>
        id="<?= esc_attr( $editor_html_id );?>"
    <?php endif; ?>
	<?php the_class_attr( $classes ); ?>
>
	<?php
	// Example of image output:
	// echo wp_get_attachment_image( $image );
	?>

    block template

</div>


<?php
/* Чтобы js работал в редакторе, необходимо его инициализацию выполнить отдельно,
после вывода разметки блока в редакторе */
if ( $is_preview ): ?>
    <script>window.initBlockTemplate();</script>
<?php endif; ?>

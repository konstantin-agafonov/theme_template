<?php if ( is_front_page() ): ?>
    <div class="logo">
        <?= file_get_contents( THEME_URL . '/_dist/assets/img/icons/short-logo.svg' ); ?>
    </div>
<?php else: ?>
    <a class="logo" href="<?= SITE_URL; ?>">
        <div>
            <?= file_get_contents( THEME_URL . '/_dist/assets/img/icons/short-logo.svg' ); ?>
        </div>
    </a>
<?php endif; ?>

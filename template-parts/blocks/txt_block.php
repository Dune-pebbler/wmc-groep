<?php
$txt_field = get_sub_field('text_field');
$color_picker = get_sub_field('color-picker');
?>
<?php if ($txt_field): ?>
    <section class="txt_block" style="background-color: <?= $color_picker; ?>;">
        <div class="flex-container">
            <div class="flex-row">
                <div class="flex-col">
                    <div class="txt_field-container">
                        <?= $txt_field; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
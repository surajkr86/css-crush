<?php
/**
 * Functions for converting pixel values into em (px2em) or rem (px2rem) values
 *
 * For both functions the optional second argument is base font-size for calculation
 * (16px by default) though usually not required when converting pixel to rem.
 *
 * @before
 *     font-size: px2em(11 13);
 *     font-size: px2rem(16);
 *
 * @after
 *     font-size: .84615em;
 *     font-size: 1rem;
 */
namespace CssCrush;

Plugin::register('px2em', array(
    'enable' => function () {
        Functions::register('px2em', 'CssCrush\fn__px2em');
        Functions::register('px2rem', 'CssCrush\fn__px2rem');
    },
    'disable' => function () {
        Functions::deRegister('px2em');
        Functions::deRegister('px2rem');
    },
));


function fn__px2em($input) {

    return px2em($input, 'em', Crush::$process->settings->get('px2em-base', 16));
}

function fn__px2rem($input) {

    return px2em($input, 'rem', Crush::$process->settings->get('px2rem-base', 16));
}

function px2em($input, $unit, $default_base) {

    list($px, $base) = Functions::parseArgsSimple($input) + array(16, $default_base);

    return round($px / $base, 5) . $unit;
}

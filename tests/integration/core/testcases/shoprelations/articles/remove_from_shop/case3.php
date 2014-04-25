<?php
/*
 * Test removing article from shop where it was created.
 */
$aData = array(
    'shops'    => array(
        array(
            'oxname' => '_testShop2',
        ),
        array(
            'oxname' => '_testShop3',
        ),
        array(
            'oxname' => '_testShop4',
        ),
    ),
    'articles' => array(
        array(
            'oxid'   => '_testArticle1',
            'oxshop' => 1,
        ),
    ),
    'actions'  => array(
        'remove_from_shop' => array(
            '_testArticle1' => array(
                1,
            ),
        ),
    ),
    'expected' => array(
        'article_in_shop'     => array(
            '_testArticle1' => array(),
        ),
        'article_not_in_shop' => array(
            '_testArticle1' => array(
                1, 2, 3, 4,
            ),
        ),
    ),
);
<?php
/**
 * Created by PhpStorm.
 * User: bangweiwei
 * Date: 2019-05-08
 * Time: 15:19
 */
return [
    [
        'type'=>'until',
        'path'=>'bw-path:>>tag:i>title:退出',
        'value'=>'appear',
        'level'=>'must',
    ],
    [
        'type'=>'usleep',
        'value'=>'400000',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'bw-path:>>tag:i>title:退出',
        'value'=>'click',
        'level'=>'must',
    ]
];
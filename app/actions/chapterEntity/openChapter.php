<?php
/**
 * 进入章节目录->打开顺序学习
 * 入口：登陆后首页
 *
 * Created by PhpStorm.
 * User: bangweiwei
 * Date: 2019-05-08
 * Time: 15:19
 */
return [
    [
    'type'=>'until',
    'path'=>'bw-path:>>tag:p>text:章节目录',
    'value'=>'appear',
    'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'bw-path:>>tag:p>text:章节目录',
        'value'=>'click',
        'level'=>'must',
    ],
];
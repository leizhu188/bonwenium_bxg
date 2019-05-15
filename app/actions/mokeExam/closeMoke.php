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
        'path'=>'x-path://*[@id="app"]/div/div[2]/div[2]/div/div[5]/div/div/div/div[1]/div/div/div[1]/i[2]',
        'value'=>'appear',
        'level'=>'must',
    ],
    [
        'type'=>'usleep',
        'value'=>'200000',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div[2]/div[2]/div/div[5]/div/div/div/div[1]/div/div/div[1]/i[2]',
        'value'=>'click',
        'level'=>'must',
    ]
];
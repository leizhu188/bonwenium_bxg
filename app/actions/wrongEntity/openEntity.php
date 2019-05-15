<?php
/**
 * 进入错题本并开始练习
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
        'path'=>'bw-path:>>tag:p>text:错题本',
        'value'=>'appear',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'bw-path:>>tag:p>text:错题本',
        'value'=>'click',
        'level'=>'must',
    ],
    [
        'type'=>'until',
        'path'=>'bw-path:>>tag:h1>text:错题练习',
        'value'=>'appear',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div[2]/div[2]/div/div[3]/div/div/div[2]/div/div/div/div/button/span',
        'value'=>'click',
        'level'=>'must',
    ],
];
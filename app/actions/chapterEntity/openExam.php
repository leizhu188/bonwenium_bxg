<?php
/**
 * 进入章节目录->打开章考试
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
        'path'=>'bw-path:>>tag:ul>class:chapter-list>>tag:li>num:0',
        'value'=>'click',
        'level'=>'must',
    ],
    [
        'type'=>'usleep',
        'value'=>'200000',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'bw-path:>>tag:span>text:章考试',
        'value'=>'click',
        'level'=>'must',
    ],
    [
        'type'=>'until',
        'path'=>'bw-path:>>tag:i>title:退出',
        'value'=>'click',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div[2]/div[2]/div/div[3]/div/div/div[2]/div/div/div/div/button/span',
        'value'=>'click',
        'level'=>'must',
    ],
];
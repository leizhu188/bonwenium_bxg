<?php
/**
 * Created by PhpStorm.
 * User: bangweiwei
 * Date: 2019-05-08
 * Time: 15:19
 */
return [
    //标识码
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[2]/div[1]/div/div/input',
        'value'=>'write:17702280001',
        'level'=>'must',
    ],
    //管理员密码
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[2]/div[2]/div/div/input',
        'value'=>'write:123456',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[2]/div[3]/div/button',
        'value'=>'click',
        'level'=>'must',
    ],
    //账号
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[1]/div[1]/div/div/input',
        'value'=>'write:17702280002',
        'level'=>'must',
    ],
    //密码
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[1]/div[2]/div/div/input',
        'value'=>'write:123456',
        'level'=>'must',
    ],
    [
        'type'=>'step',
        'path'=>'x-path://*[@id="app"]/div/div/div/form[1]/div[3]/div/button[1]',
        'value'=>'click',
        'level'=>'must',
    ],
];
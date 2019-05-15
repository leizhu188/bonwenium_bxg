<?php
/*
 * 流程线：
 * 一次测试流程的分发口
 */
return [
    //登陆
    app('actions.user.loginAction'),

    //打开错题本
    app('actions.wrongEntity.openEntity'),
    //开始做题
    [
        'type'=>'function',
        'value'=>'wrongFunction@finishWrongEntitys@{}',
    ],
    //关闭错题本
    app('actions.closeDialog'),
];
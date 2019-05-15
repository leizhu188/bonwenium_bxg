<?php
/*
 * 流程线：
 * 一次测试流程的分发口
 */
return [
    //登陆
    app('actions.user.loginAction'),

    //打开章节目录
    app('actions.chapterEntity.openChapter'),
    //选章节->点击顺序练习
    app('actions.chapterEntity.openStudy'),
    //开始做题
    [
        'type'=>'function',
        'value'=>'chapterFunction@finishAnswerEntitys@{}',
    ],
    //关闭做题板
    app('actions.closeDialog'),
    //关闭章节目录板
    app('actions.chapterEntity.closeChapter'),

    //打开章节目录
    app('actions.chapterEntity.openChapter'),
    //打开章节目录 -> 章节考试
    app('actions.chapterEntity.openExam'),
    //开始蒙试卷
    [
        'type'=>'function',
        'value'=>'chapterFunction@finishAnswerEntitys@{}',
    ],
    //关闭做题板
    app('actions.closeDialog'),
    //关闭章节目录板
    app('actions.chapterEntity.closeChapter'),

    //打开错题本
    app('actions.wrongEntity.openEntity'),
    //开始做题
    [
        'type'=>'function',
        'value'=>'wrongFunction@finishWrongEntitys@{}',
    ],
    //关闭错题本
    app('actions.closeDialog'),

    //点击真题模考
    app('actions.mokeExam.openMoke'),
    //点击开始考试
    app('actions.mokeExam.openStartExam'),
    //开始蒙试卷
    [
        'type'=>'function',
        'value'=>'chapterFunction@finishAnswerEntitys@{}',
    ],
    //关闭做题板
    app('actions.closeDialog'),
    //关闭真题模考
    app('actions.mokeExam.closeMoke'),
];
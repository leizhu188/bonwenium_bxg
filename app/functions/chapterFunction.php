<?php
/**
 * Created by PhpStorm.
 * User: bonwe
 * Date: 2019-03-28
 * Time: 14:28
 */

namespace App\Functions;



class chapterFunction extends BaseFunction
{

    /*
     * 盲做 -> 交卷
     */
    public function finishAnswerEntitys(){
        while (!self::isEndedAnswer()){
            //获取题目游戏类型
            $this->nowEntityType = self::getEntitytype();
            // 蒙答案 并翻页
            self::passEntity();
        }

        //交卷
        parent::doStep(
            [
                'type'=>'step',
                'path'=> 'x-path://*[@id="app"]/div/div[2]/div[2]/div/div[3]/div/div/div[3]/div/div/div/div[1]/div/i[2]',
                'value'=>'click',
                'level'=>'must',
            ]
        );
        parent::doStep(
            [
                'type'=>'step',
                'path'=> 'bw-path:>>tag:span>text:交卷',
                'value'=>'click',
                'level'=>'must',
            ]
        );
        parent::doStep(
            [
                'type'=>'step',
                'path'=> 'bw-path:>>tag:span>text:确定',
                'value'=>'click',
                'level'=>'must',
            ]
        );
    }

    protected $nowEntityType = "";

    private function getEntitytype(){
        $element = parent::getElementByStr("bw-path:>>tag:div>class:letter>text:A");
        if (!empty($element)){//有选项
            return 'check';
        }

        return 'space';
    }

    private function passEntity(){
        if ($this->nowEntityType == 'space'){
            //填空
            $blacks = parent::getElementByStr("bw-path:>>tag:span>type:text");
            foreach ($blacks as $k=>$black){
                $path = 'bw-path:>>tag:span>type:text>num:'.$k;
                parent::doStep(
                    [
                        'type'=>'step',
                        'path'=>$path,
                        'value'=>'write:bonwenium',
                        'level'=>'must',
                    ]
                );
            }
            //下一题
            usleep(200000);
            parent::doStep(
                [
                    'type'=>'step',
                    'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                    'value'=>'click',
                    'level'=>'must',
                ]
            );

            return;
        }

        if ($this->nowEntityType == 'check'){
            //选一个
            $options = parent::getElementByStr("bw-path:>>tag:div>class:option>>tag:div>class:letter");
            if ($opCount = count($options)){
                $options[random_int(0,$opCount-1)]->click();
            }
            //下一题
            usleep(200000);
            parent::doStep(
                [
                    'type'=>'step',
                    'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                    'value'=>'click',
                    'level'=>'must',
                ]
            );
            return;
        }
    }

    private function isEndedAnswer(){
        $elements = parent::getElementByStr("bw-path:>>tag:i>class:iconfont icon-arrow-right");
        return empty($elements);
    }

}
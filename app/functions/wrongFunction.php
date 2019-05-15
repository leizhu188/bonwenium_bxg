<?php
/**
 * Created by PhpStorm.
 * User: bonwe
 * Date: 2019-03-28
 * Time: 14:28
 */

namespace App\Functions;



class wrongFunction extends BaseFunction
{

    /*
     * 盲做 -> 出现正确答案 -> 采集 -> 正确作答
     */
    public function finishWrongEntitys(){
        while (!self::isEndedAnswer()){
            //获取题目游戏类型
            $this->nowEntityType = self::getEntitytype();
            //获取题目id
            $this->nowEntityId = self::getEntityId();
            //获取答案
            $answer = self::getEntityAnswer();

            if (empty($answer)){
                // 采集答案 并翻页
                self::passEntity();
            }else{
                if (empty($answer['answer'])){
                    self::clearEntityAnswer();
                }
                // 作答 并翻页
                self::answerEntity($answer);
            }
        }

        self::clearEntityAnswer();
    }

    protected $nowEntityId = 0;
    protected $nowEntityType = "";
    const REDIS_ANSWER_KEY = "bxg_wrong_entity_answer";

    private function getEntitytype(){
        $element = parent::getElementByStr("bw-path:>>tag:div>class:letter>text:A");
        if (!empty($element)){//有选项
            return 'check';
        }

        return 'space';
    }

    private function getEntityId(){
        $elements = parent::getElementByStr("bw-path:>>tag:div>class:van-dialog hk-dialog");
        if (!empty($elements)){
            $id = $elements[0]->getAttribute('data-exercise-id');
        }

        return $id;
    }

    private function getEntityAnswer(){
        $answer = $this->redis()->get(self::REDIS_ANSWER_KEY);
        if (empty($answer)){
            return null;
        }

        $answer = json_decode($answer,true);
        if (!isset($answer[$this->nowEntityId])){
            return null;
        }

        return $answer[$this->nowEntityId];
    }

    private function setEntityAnswer($collect){
        $answer = $this->redis()->get(self::REDIS_ANSWER_KEY);
        if (empty($answer)){
            $answer = [];
        }else{
            $answer = json_decode($answer,true);
        }

        $answer[$this->nowEntityId] = $collect;

        $this->redis()->set(self::REDIS_ANSWER_KEY,json_encode($answer));
    }

    private function clearEntityAnswer(){
        $this->redis()->del([self::REDIS_ANSWER_KEY]);
    }

    private function collectEntityAnswer(){
        $answer = ['type'=>$this->nowEntityType,'answer'=>[]];
        if ($this->nowEntityType == 'space'){
            $elements = parent::getElementByStr("bw-path:>>tag:span>class:success bracketed");
            foreach ($elements as $element){
                $answer['answer'] []=$element->getText();
            }
        }
        if ($this->nowEntityType == 'check'){
            $elements = parent::getElementByStr("bw-path:>>tag:div>class:letter success");
            foreach ($elements as $element){
                $answer['answer'] []=$element->getText();
            }
        }

        self::setEntityAnswer($answer);
    }

    private function finishEntityAnswer($answer){
        if ($this->nowEntityType == 'check'){
            $path = 'bw-path:>>tag:div>class:letter>text:'.$answer['answer'][0];
            parent::doStep(
                [
                    'type'=>'step',
                    'path'=>$path,
                    'value'=>'click',
                    'level'=>'must',
                ]
            );
        }
        if ($this->nowEntityType == 'space'){
            foreach ($answer['answer'] as $key=>$value){
                $path = 'bw-path:>>tag:span>type:text>class:blank-input>num:'.$key;
                parent::doStep(
                    [
                        'type'=>'step',
                        'path'=>$path,
                        'value'=>'write:'.strtolower($value),
                        'level'=>'must',
                    ]
                );
            }
        }
    }

    private function passEntity(){
        if ($this->nowEntityType == 'space'){
            //页面没出现正确答案 点击下一页
            if (!count(parent::getElementByStr("bw-path:>>tag:span>class:success bracketed"))){
                parent::doStep(
                    [
                        'type'=>'step',
                        'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                        'value'=>'click',
                        'level'=>'must',
                    ]
                );
            }
            usleep(200000);
            self::collectEntityAnswer();
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
            //页面没出现正确答案 选A然后下一页
            if (!count(parent::getElementByStr("bw-path:>>tag:div>class:letter success"))){
                parent::doStep(
                    [
                        'type'=>'step',
                        'path'=>'bw-path:>>tag:div>class:letter>text:A',
                        'value'=>'click',
                        'level'=>'must',
                    ]
                );
                usleep(200000);
                parent::doStep(
                    [
                        'type'=>'step',
                        'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                        'value'=>'click',
                        'level'=>'must',
                    ]
                );
                usleep(200000);
            }
            self::collectEntityAnswer();
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

    private function answerEntity($answer){
        //填答案
        self::finishEntityAnswer($answer);

        parent::doStep(
            [
                'type'=>'step',
                'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                'value'=>'click',
                'level'=>'must',
            ]
        );
        usleep(200000);
        parent::doStep(
            [
                'type'=>'step',
                'path'=>'bw-path:>>tag:i>class:iconfont icon-arrow-right',
                'value'=>'click',
                'level'=>'must',
            ]
        );
    }

    private function isEndedAnswer(){
        $elements = parent::getElementByStr("bw-path:>>tag:i>class:iconfont icon-arrow-right");
        if (empty($elements)){
            $elements = parent::getElementByStr("bw-path:>>tag:i>class:iconfont icon-arrow-right disabled");
        }
        return empty($elements);
    }

}
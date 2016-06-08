<?php

namespace app\models;
use yii;

class Position extends \yii\db\ActiveRecord
{
    public $childrenIds;
    public $childrenList;

    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['id', 'status', 'p_id', 'ord', 'is_leaf', 'is_last', 'level', 'is_class'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe', 'full_alias', 'shuoming','zhiquan','zhize','zhibiao'],'safe']
        ];
    }

    public function attributeLabels(){
        return [
            'name' => '名称',
            'alias' => '别名',
            'full_alias' => '完整别名',
            'describe' => '描述',
            'p_id' => '父级',
            'level' => '层级',
            'is_leaf' => '是否叶级',
            //'is_class' => '是否类',
            //'is_last' => '最后一个',
            'ord' => '排序',
            'status' => '状态',
            'shuoming' => '个人岗位说明',
            'zhiquan' => '个人岗位职权',
            'zhize' => '个人岗位职责',
            'zhibiao' => '个人绩效指标',
        ];
    }

    /*CREATE TABLE `position` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(100) NOT NULL COMMENT '部门/职位名称',
     `describe` text NOT NULL,
     `p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父位置id,一级位置为0',
     `level` int(4) unsigned DEFAULT '0' COMMENT '层级',
     `is_leaf` tinyint(1) unsigned DEFAULT '0' COMMENT '0:部门;1:职位;',
     `is_class` tinyint(1) unsigned DEFAULT '0' COMMENT '0:不在,1:在中心的组织架构中出现;',
     `is_last` tinyint(1) unsigned DEFAULT '0' COMMENT '实际排序当前同级下最后一个',
     `ord` int(4) unsigned DEFAULT '0' COMMENT '排序,倒序从大到小',
     `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8*/



/*ALTER TABLE `position` ADD `shuoming` VARCHAR(255) DEFAULT NULL ,
ADD `zhiquan` VARCHAR(255) DEFAULT NULL ,
ADD `zhize` VARCHAR(255) DEFAULT NULL ,
ADD `zhibiao` VARCHAR(255) DEFAULT NULL ;*/


/*ALTER TABLE `position` ADD `alias` VARCHAR(255) DEFAULT NULL AFTER `name`;*/

/*ALTER TABLE `position` ADD `full_alias` VARCHAR(255) DEFAULT NULL AFTER `alias`;*/

    public $installArr;

    public function __construct(){
        //职位 普通设置1
        $zw_1 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true]
        ];
        //职位 普通设置2
        $zw_2 = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true]
        ];
        //职位 普通设置3
        $zw_3 = [
            ['n'=>'指导','a'=>'zd','l'=>true],
            ['n'=>'师','a'=>'s','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true],
            ['n'=>'助理','a'=>'zl','l'=>true]
        ];

        //职位 各个中心
        $zw_zx = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'经理','a'=>'jl','l'=>true],
            ['n'=>'主管','a'=>'zg','l'=>true],
            ['n'=>'专员','a'=>'zy','l'=>true]
        ];
        //职位 综合管理部
        $zw_zgb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'行政主管','a'=>'xzzg','l'=>true],
            ['n'=>'行政专员','a'=>'xzzy','l'=>true],
            ['n'=>'前台','a'=>'qt','l'=>true],
            ['n'=>'人事经理','a'=>'rsjl','l'=>true],
            ['n'=>'人事主管','a'=>'rszg','l'=>true],
            ['n'=>'人事专员','a'=>'rszy','l'=>true],
            ['n'=>'网管','a'=>'wg','l'=>true],
        ];
        //职位 财务部
        $zw_cwb = [
            ['n'=>'财务总监','a'=>'cwzj','l'=>true],
            ['n'=>'主办会计','a'=>'zbkj','l'=>true],
            ['n'=>'会计','a'=>'kj','l'=>true],
            ['n'=>'出纳','a'=>'cn','l'=>true]
        ];

        //职位 总经办
        $zw_zjb = [
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'办公室主任','a'=>'bgszr','l'=>true],
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'总经理助理','a'=>'zjlzl','l'=>true],
            ['n'=>'司机','a'=>'sj','l'=>true]
        ];


        //职位 颂唐地产 销售业务部
        $zw_stdc_xsywb = [
            ['n'=>'总监','a'=>'zj','l'=>true],
            ['n'=>'副总监','a'=>'fzj','l'=>true],
            ['n'=>'总经理','a'=>'zjl','l'=>true],
            ['n'=>'副总经理','a'=>'fzjl','l'=>true],
            ['n'=>'策划副总监','a'=>'chfzj','l'=>true],
        ];
        //职位 颂唐地产 案场
        $zw_stdc_ac = [
            ['n'=>'项目总监','a'=>'xmzj','l'=>true],
            ['n'=>'项目副总监','a'=>'xmfzj','l'=>true],
            ['n'=>'项目经理','a'=>'xmjl','l'=>true],
            ['n'=>'项目副经理','a'=>'xmfjl','l'=>true],
            ['n'=>'销售总监','a'=>'xszj','l'=>true],
            ['n'=>'销售副总监','a'=>'xsfzy','l'=>true],
            ['n'=>'销售经理','a'=>'xsjl','l'=>true],
            ['n'=>'销售主管','a'=>'xszg','l'=>true],
            ['n'=>'销售专员','a'=>'xszy','l'=>true],
            ['n'=>'案场行政','a'=>'acxz','l'=>true],
            ['n'=>'策划主管','a'=>'chzg','l'=>true],
            ['n'=>'策划经理','a'=>'chjl','l'=>true],
            ['n'=>'策划副经理','a'=>'chfjl','l'=>true],
            ['n'=>'策划','a'=>'ch','l'=>true],
            ['n'=>'渠道主管','a'=>'qdzg','l'=>true],
            ['n'=>'实习生','a'=>'sxs','l'=>true]
        ];


        //职位 颂唐广告 AE策划部
        $zw_stgg_aechb = [
            ['n'=>'策划总监','a'=>'chzy','l'=>true],
            ['n'=>'策划主管','a'=>'chzg','l'=>true],
            ['n'=>'策划经理','a'=>'chjl','l'=>true],
            ['n'=>'策划师','a'=>'chs','l'=>true],
            ['n'=>'策划助理','a'=>'chzl','l'=>true],
            ['n'=>'AE总监','a'=>'aezj','l'=>true],
            ['n'=>'AE经理','a'=>'aejl','l'=>true],
            ['n'=>'AE专员','a'=>'aezy','l'=>true],
            ['n'=>'活动策划','a'=>'hdch','l'=>true],
            ['n'=>'执行策划','a'=>'zxch','l'=>true],
            ['n'=>'企策设计总监','a'=>'qcsjzj','l'=>true],
        ];



        //职位 颂唐广告 创作部
        $zw_stgg_czb = [
            ['n'=>'文案总监','a'=>'wazj','l'=>true],
            ['n'=>'文案指导','a'=>'wazd','l'=>true],
            ['n'=>'文案','a'=>'wa','l'=>true],
            ['n'=>'设计总监','a'=>'sjzj','l'=>true],
            ['n'=>'美术指导','a'=>'mszy','l'=>true],
            ['n'=>'设计师','a'=>'sjs','l'=>true],
            ['n'=>'策划总监','a'=>'chzj','l'=>true],
            ['n'=>'策划','a'=>'ch','l'=>true]
        ];



        //职位 上海颂唐广告 创作部
        /*$zw_shstgg_czb = [
            ['n'=>'部门管理','a'=>'bmgl','c'=>$zw_2],
            ['n'=>'设计','a'=>'sjs','c'=>$zw_3],
            ['n'=>'美术','a'=>'ms','c'=>$zw_3],
            ['n'=>'文案','a'=>'wa','c'=>$zw_3],
        ];*/

        //职位 苏州颂唐广告 创作部
        /*$zw_szstgg_czb = [
            ['n'=>'文案总监','a'=>'wazj','l'=>true],
            ['n'=>'文案专员','a'=>'wazy','l'=>true],
            ['n'=>'设计总监','a'=>'sjzj','l'=>true],
            ['n'=>'设计专员','a'=>'sjzy','l'=>true],
            ['n'=>'策划总监','a'=>'chzj','l'=>true],
            ['n'=>'策划专员','a'=>'chzy','l'=>true]
        ];*/

        //职位 上海颂唐广告 策划部
        /*$zw_shstgg_chb = [
            ['n'=>'策划经理','a'=>'chjl','l'=>true],
            ['n'=>'策划师','a'=>'chs','l'=>true],
            ['n'=>'策划助理','a'=>'chzl','l'=>true],
            ['n'=>'策划专员','a'=>'chzy','l'=>true]
        ];*/
        //职位 上海颂唐广告 执行策划
        /*$zw_shstgg_zxch = [
            ['n'=>'执行策划','a'=>'zxch','l'=>true],
        ];*/

        //部门 颂唐地产 上海
        $bm_dc_sh = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'宝山上坤上街案场','a'=>'bssksjac','c'=>$zw_stdc_ac],
                ['n'=>'绍兴锦园案场','a'=>'sxjyac','c'=>$zw_stdc_ac],
                ['n'=>'天津麦谷案场','a'=>'tjmgac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];

        //部门 颂唐地产 无锡
        $bm_dc_wx = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'国信世家案场','a'=>'gxsjac','c'=>$zw_stdc_ac],
                ['n'=>'君悦案场','a'=>'jyac','c'=>$zw_stdc_ac],
                ['n'=>'天氿御城案场','a'=>'tgycac','c'=>$zw_stdc_ac],
                ['n'=>'中交上东湾案场','a'=>'zjsdwac','c'=>$zw_stdc_ac],
                ['n'=>'天御广场案场','a'=>'tygcac','c'=>$zw_stdc_ac],
                ['n'=>'星湖花海案场','a'=>'xhhhac','c'=>$zw_stdc_ac],
                ['n'=>'赛维拉案场','a'=>'slwac','c'=>$zw_stdc_ac],
                ['n'=>'城开国际案场','a'=>'ckgjac','c'=>$zw_stdc_ac],
                ['n'=>'金鑫广场案场','a'=>'jxgcac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];

        //部门 颂唐地产 苏州
        $bm_dc_sz = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'鸿汉案场','a'=>'hhac','c'=>$zw_stdc_ac],
                ['n'=>'瑞景国际案场','a'=>'rjgjac','c'=>$zw_stdc_ac],
                ['n'=>'恒业站前案场','a'=>'hyzqac','c'=>$zw_stdc_ac],
                ['n'=>'华邦案场','a'=>'hbac','c'=>$zw_stdc_ac],
                ['n'=>'常州莱蒙城案场','a'=>'czlmcac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];

        //部门 颂唐地产 南京
        $bm_dc_nj = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'卧龙湖案场','a'=>'wlhac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];

        //部门 颂唐地产 合肥
        $bm_dc_hf = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'阜阳金悦国际案场','a'=>'fyjygjac','c'=>$zw_stdc_ac],
                ['n'=>'阜阳幸福华庭案场','a'=>'fyxfhtac','c'=>$zw_stdc_ac],
                ['n'=>'黄山秀湖秘境案场','a'=>'hsxhmjac','c'=>$zw_stdc_ac],
                ['n'=>'池州江南世家案场','a'=>'czjnsjac','c'=>$zw_stdc_ac],
                ['n'=>'巢湖盛景广场案场','a'=>'chsjgcac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];
        //部门 颂唐地产 呵呵浩特
        $bm_dc_hhht = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'市场策划部','a'=>'scchb','c'=>$zw_1],
            ['n'=>'销售业务部','a'=>'xsywb','c'=>array_merge($zw_stdc_xsywb,[
                ['n'=>'金华学府案场','a'=>'jhxfac','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_stdc_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_stdc_ac]
            ])]
        ];

        //部门 颂唐广告 上海
        $bm_gg_2 = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'AE策划部','a'=>'aechb','c'=>$zw_stgg_aechb],
            ['n'=>'创作部','a'=>'czb','c'=>[//array_merge($zw_stgg_aechb,[
                ['n'=>'创作部一组','a'=>'czb_1','c'=>$zw_stgg_czb],
                ['n'=>'创作部二组','a'=>'czb_2','c'=>$zw_stgg_czb],
                ['n'=>'创作部三组','a'=>'czb_3','c'=>$zw_stgg_czb],
                ['n'=>'创作部四组','a'=>'czb_4','c'=>$zw_stgg_czb]
            ]],
        ];

        //部门 颂唐广告
        $bm_gg = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'开发拓展部','a'=>'kftzb','c'=>$zw_1],
            ['n'=>'AE策划部','a'=>'aechb','c'=>$zw_stgg_aechb],
            ['n'=>'创作部','a'=>'czb','c'=>$zw_stgg_czb]
        ];
        $zw_shrxsy_ac = [
            ['n'=>'项目总监','a'=>'xmzj','l'=>true],
            ['n'=>'项目副总监','a'=>'xmfzj','l'=>true],
            ['n'=>'项目经理','a'=>'xmjl','l'=>true],
            ['n'=>'项目副经理','a'=>'xmfjl','l'=>true],
            ['n'=>'招商总监','a'=>'zszj','l'=>true],
            ['n'=>'招商副总监','a'=>'zsfzy','l'=>true],
            ['n'=>'招商经理','a'=>'zsjl','l'=>true],
            ['n'=>'招商主管','a'=>'zszg','l'=>true],
            ['n'=>'招商专员','a'=>'zszy','l'=>true],
            ['n'=>'案场行政','a'=>'acxz','l'=>true],
            ['n'=>'策划主管','a'=>'chzg','l'=>true],
            ['n'=>'策划经理','a'=>'chjl','l'=>true],
            ['n'=>'策划副经理','a'=>'chfjl','l'=>true],
            ['n'=>'策划','a'=>'ch','l'=>true],
            ['n'=>'渠道主管','a'=>'qdzg','l'=>true],
            ['n'=>'实习生','a'=>'sxs','l'=>true]
        ];
        //部门 日鑫商业 上海
        $bm_rx_sh = [
            ['n'=>'总经办','a'=>'zjb','c'=>$zw_zjb],
            ['n'=>'品牌拓展部','a'=>'pptzb','c'=>$zw_1],
            ['n'=>'商业策划部','a'=>'sychb','c'=>$zw_1],
            ['n'=>'商业招商部','a'=>'syzsb','c'=>[
                ['n'=>'吴江案场','a'=>'wjac','c'=>$zw_shrxsy_ac],
                ['n'=>'阜阳案场','a'=>'fyac','c'=>$zw_shrxsy_ac],
                ['n'=>'彩生活案场','a'=>'cshac','c'=>$zw_shrxsy_ac],
                ['n'=>'项目案场[A]','a'=>'xmac_1','c'=>$zw_shrxsy_ac],
                ['n'=>'项目案场[B]','a'=>'xmac_2','c'=>$zw_shrxsy_ac],
            ]]
        ];

        $this->installArr = [
            ['n'=>'系统管理员','l'=>true,'a'=>'admin'],
            ['n'=>'颂唐机构','a'=>'stjg','c'=>[
                ['n'=>'发展管控中心','a'=>'fzgkzx','c'=>$zw_zx],
                ['n'=>'行政管控中心','a'=>'xzgkzx','c'=>$zw_zx],
                ['n'=>'财务管控中心','a'=>'cwgkzx','c'=>$zw_zx],
                ['n'=>'企宣管控中心','a'=>'qxgkzx','c'=>$zw_zx],
                ['n'=>'市场策略中心','a'=>'scclzx','c'=>$zw_zx],
                ['n'=>'上海','a'=>'sh','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_sh],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                    ['n'=>'日鑫商业','a'=>'rxsy','c'=>$bm_rx_sh]
                ]],
                ['n'=>'苏州','a'=>'sz','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_sz],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg_2]
                ]],
                ['n'=>'无锡','a'=>'wx','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_wx],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                ]],
                ['n'=>'南京','a'=>'nj','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_nj],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                ]],
                ['n'=>'合肥','a'=>'hf','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_hf],
                    ['n'=>'颂唐广告','a'=>'stgg','c'=>$bm_gg],
                ]],
                ['n'=>'呼和浩特','a'=>'hhht','c'=>[
                    ['n'=>'综合管理部','a'=>'zhglb','c'=>$zw_zgb],
                    ['n'=>'财务部','a'=>'cwb','c'=>$zw_cwb],
                    ['n'=>'颂唐地产','a'=>'stdc','c'=>$bm_dc_hhht],
                ]]
            ]],
        ];
    }


    public function install2() {
        try {
            $exist = Position::find()->one();
            if($exist){
                throw new yii\base\Exception('Position has installed');
            }






            $this->array2value($this->installArr,0,1);
            return true;
        }catch (\Exception $e)
        {
            echo  'Position 2222 install failed<br />';
            $message = $e->getMessage() . "\n";
            $errorInfo = $e instanceof \PDOException ? $e->errorInfo : null;
            echo $message;
            /*echo '<br/><br/>';
            var_dump($errorInfo);*/

            //throw new \Exception($message, $errorInfo, (int) $e->getCode(), $e);
            return false;
        }
    }

    public function array2value($arr,$pid,$level){

        $sqlbase = "INSERT IGNORE INTO `position`(`name`,`alias`,`p_id`,`is_leaf`,`is_last`,`is_class`,`level`,`ord`,`status`)
                VALUES";
        $ord = 99;
        $i = 1;
        foreach($arr as $a){
            $isLast = $i == count($arr)?1:0;
            $is_leaf = isset($a['l']) && $a['l']==1?1:0;
            $is_class = isset($a['cl']) && $a['cl']==1?1:0;
            $name = isset($a['n']) && $a['n']!=''?$a['n']:'默认名称';
            $alias = isset($a['a']) && $a['a']!=''?$a['a']:'默认别名';
            $sql = $sqlbase."('".$name."','".$alias."',$pid,$is_leaf,$isLast,$is_class,$level,$ord,1)";
            $cmd = Yii::$app->db->createCommand($sql);
            $cmd->execute();

            //$lastId = Yii::app()->db->lastInsertID;
            if(isset($a['c']) && !empty($a['c'])){
                $this->array2value($a['c'],Yii::$app->db->lastInsertID,$level+1);
            }
            $ord--;
            $i++;
        }
    }
}
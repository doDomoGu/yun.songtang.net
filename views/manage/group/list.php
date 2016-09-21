<?php
    $this->title = '群组设置';
    use yii\bootstrap\BaseHtml;
    use app\components\DirFunc;
    //\app\assets\AppAsset::addJsFile($this,'js/manage-dir.js');
?>
<p>
    <a href="group-add-and-edit" class="btn btn-primary">新建群组</a>
</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <!--<th>排序</th>-->
        <th>群组名</th>
        <th>人数</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)):?>
        <?php foreach($list as $l):?>
            <tr>
                <th scope="row"><?=$l->id?></th>
                <!--<td><?/*=$l->ord*/?></td>-->
                <td><?=$l->name?></td>
                <td><?=count($l->user)?></td>
                <td><?=$l->status==1?'启用':'<span style="color:red;">禁用</span>'?></td>
                <td>
                    <?=BaseHtml::a('编辑',['group-add-and-edit','id'=>$l->id],['class'=>'btn btn-primary btn-xs'])?>
                    <?=BaseHtml::a('职员列表',['group-user','id'=>$l->id],['class'=>'btn btn-success btn-xs'])?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>

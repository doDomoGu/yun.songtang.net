<?php
    app\assets\AppAsset::addCssFile($this,'css/site-index.css');
    app\assets\AppAsset::addJsFile($this,'js/main/site-index.js');
?>

<div class="clearfix"></div>
<div id="site-index">
    <aside>
        <div class="clearfix"></div>
        <section id="email-login">
            <article>
                <span><a href="http://exmail.qq.com/login" target="_blank">颂唐邮箱登录</a></span>
            </article>
            <aside>
                <span>
                    <form onsubmit="return checkInput()" method="post" target="_blank" action="https://exmail.qq.com/cgi-bin/login" name="form1"><input type="hidden" value="false" name="firstlogin"><input type="hidden" value="dm_loginpage" name="errtemplate"><input type="hidden" value="other" name="aliastype"><input type="hidden" value="bizmail" name="dmtype"><input type="hidden" value="" name="p"><div class="bizmail_column"><label>帐号:</label><div class="bizmail_inputArea"><input type="text" value="" class="text" name="uin">@<span>songtang.net</span><input type="hidden" value="songtang.net" name="domain"></div></div><div class="bizmail_column"><label>密码:</label><div class="bizmail_inputArea"><input type="password" value="" class="text1" name="pwd"></div></div><div class="bizmail_SubmitArea"><input type="submit" value="" style="width:66px;" name="" class="buttom"></div><a target="_blank" href="https://exmail.qq.com/cgi-bin/readtemplate?check=false&amp;t=bizmail_orz">忘记密码？</a></form>

                </span>
            </aside>
        </section>

    </aside>
    <main>
        <section id="dir-list">
            <?php for($i=1;$i<=count($list_dirOne);$i++):?>
                <article class="<?=$i==count($list_dirOne)?'last':''?>">
                    <div class="item-heading">
                        <?=yii\bootstrap\Html::a($list_dirOne[$i]->name,['/dir','dir_id'=>$list_dirOne[$i]->id])?>
                    </div>
                    <div class="item-list">
                        <ul class="list-unstyled">
                        <?php $j=0;foreach(${'list_'.$i} as $l):?>
                            <li>
                                <?=yii\bootstrap\Html::a($l->name,['/dir','dir_id'=>$l->id])?>
                            </li>
                        <?php $j++;endforeach;?>
                        <?php for($k=$j;$k<5;$k++):?>
                            <li>

                            </li>
                        <?php endfor;?>
                        </ul>
                    </div>
                </article>
            <?php endfor;?>
        </section>
        <div class="clearfix"></div>

        <section id="article-link">
            <article id="article-link-1">
                <span><a href="/" target="_blank">唐 讯</a></span>
            </article>
            <article id="article-link-2">
                <span><a href="/" target="_blank">唐 刊</a></span>
            </article>
            <article id="article-link-3">
                <span><a href="/" target="_blank">唐 鉴</a></span>
            </article>
        </section>
        </main>
</div>
<div class="clearfix"></div>
<div class="tpl-content-wrapper">
    <div class="row-content am-cf">
        <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                <div class="widget am-cf">
                    <div class="widget-head am-cf">
                        <div class="widget-title am-fl">更新文章</div>
                        <div class="widget-function am-fr">
                            <a href="javascript:;" class="am-icon-cog"></a>
                        </div>
                    </div>
                    <div class="widget-body am-fr">
                        <form class="am-form tpl-form-border-form tpl-form-border-br" method="post">
                            <input name="_csrf-backend" type="hidden" id="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                            <input name="id" type="hidden" id="id" value="<?= $article->id ?>">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">标题 <span class="tpl-form-line-small-title">Caption</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="caption" name="caption" placeholder="请输入标题文字">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">简介 <span class="tpl-form-line-small-title">Summary</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="summary" name="summary">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">分类 <span class="tpl-form-line-small-title">Category</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="category" name="category" >
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">内容</label>
                                <div class="am-u-sm-9">
                                    <textarea class="" rows="10" id="content" name="content" placeholder="请输入文章内容"></textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

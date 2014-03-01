
<div class="box gradient">
    <div class="title">
        <h3> <i class="icon-book"></i><span>Branch Master<span class="botton_mergin3"></span>
                <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/branchMaster/create"><button class="btn btn-success" rel="tooltip" data-placement="right">Create</button><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/branchmasterMoredetail"><button class="btn btn-success" rel="tooltip" data-placement="right">List Branch Contact</button></a></span></span></h3>
    </div>

    <script>
        $(document).ajaxStop(function() {
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array('width' => '200', 'height' => '200'),
        )
);
?>
});
    </script>
    <?php
    $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target' => 'a[rel=gallery]',
        'config' => array('width' => '100', 'height' => '100'),
            )
    );
    ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array
        (
        'dataProvider' => $dataProvider,
        'summaryText' => '',
        'ajaxUpdate' => false,
        'emptyText' => 'There is no Branch Information in your database',
        'columns' => array
            (
            array
                (
                'name' => 'branch_name',
                'htmlOptions' => array("style" => "text-align:center"),
            ),
            array
                (
                'name' => 'address',
                'htmlOptions' => array("style" => "text-align:center"),
            ),
            array
                (
                'name' => 'phone_no',
                'htmlOptions' => array("style" => "text-align:center"),
            ),
            array
                (// display a column with "view", "update" and "delete" buttons
                'class' => 'CButtonColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => array(
                    'view' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
                        'url' => 'Yii::app()->createUrl("/BranchMaster/".$data->id)',
                        'options' => array(
                            'class' => 'iframe show',
                            //'id'=>'show',
                            'rel' => 'gallery',
                            'style' => 'margin-right:6px;',
                        ),
                    ),
                    'update' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                        //'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
                        'options' => array(
                            //'class' =>'gicon-eye-open btn btn-small',
                            'style' => 'margin-right:6px;',
                        ),
                    ),
                    'delete' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                        //'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
                        'options' => array(
                            //'class' =>'gicon-eye-open btn btn-small',
                            'style' => 'margin-right:6px;',
                        ),
                    ),
                ),
                'header' => 'Action',
            ),
        ),
        'itemsCssClass' => 'responsive table table-striped table-bordered',
            //'htmlOptions'=>array('class'=>'responsive table table-striped table-bordered'),
    ));
    ?>


    <!-- End .content -->
</div>
</div>

<style>
    .button-column{
        width:115px!important;
    }
</style>

<?php /* $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
  ));
 */ ?>

</div>
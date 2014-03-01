<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i><span>Hotel Master<span class="botton_mergin"></span>
                <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/HotelMaster/create"><button class="btn btn-success" rel="tooltip" data-placement="right">create</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/hotelmoreDetail/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Contact Detail</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/hotelInfo/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List hotel Infomation</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/hotelTariff/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Hotel Tariff</button></a></span></span></span></span>
        </h3>
    </div><br />
    <div>

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
                'name' => 'hotel_name',
                'htmlOptions' => array("style" => "text-align:center"),
            ),
            array
                (
                'name' => 'short_code',
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
                (
                'name' => 'choose_branch',
                'htmlOptions' => array("style" => "text-align:center"),
                'value' => 'ApprovedMaster::model()->getBranchname($data->choose_branch)',
            ),
            array
                (
                'name' => 'hotel_rating',
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
                        'url' => 'Yii::app()->createUrl("/hotelMaster/".$data->id)',
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
    <style>
        .button-column{
            width:115px!important;
        }
    </style>



    <!-- End .content -->
</div>
</div>

    <?php /* $this->widget('zii.widgets.CListView', array(
      'dataProvider'=>$dataProvider,
      'itemView'=>'_view',
      ));
     */ ?>

</div>
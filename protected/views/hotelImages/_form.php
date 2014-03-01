   <div class="span12">
	   <div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
       <div class="box gradient">
         <div>
              <div class="title">
                 <h3>
					<i class="icon-book"></i><span>Hotel Images<span class="botton_mergin"></span>
					<span class="botton_margin1"><a href="<?php echo Yii::app()->createUrl("HotelImages/admin", array("id"=>$this->hotel_id)); ?>" class="btn btn-success">Images</a></span>
                   </h3>
               </div>
           </div>
         <div class="content">
			<?php
            $form = $this->beginWidget('CActiveForm', array(
				'id' => 'hotel-images-form',
				'enableAjaxValidation' => false,
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
			)); ?>
			<?php 
				if($this->getAction()->getId() == 'create'){
			?>
				<div class="form-row control-group row-fluid">
					<div class="form-horizontal span6">
						<div class="form-row control-group row-fluid fluid">
							<?php echo $form->fileField($model, 'url',array('id'=>'fHotelImages')); ?>
							<p>(Use .jpg, .jpeg, .gif, .png images of less than 5MB)</p>
						</div>
					</div>
				 </div>  
				 
			<?php				
				}
			?>	 
             <div class="form-row control-group row-fluid">
				<div class="form-horizontal span6">
				 <div class="form-row control-group row-fluid fluid">
					 <?php echo $form->textField($model,'caption',array('size'=>60,'maxlength'=>255, 'placeholder'=>'Caption')); ?>
				   </div>
				</div>
             </div>  
             <div class="form-actions row-fluid">
                 <div class="span7 offset3">
                     <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
                     <button type="reset" class="btn btn-secondary">Cancel</button>
                 </div>
             </div>			
              <?php $this->endWidget(); ?>
         
         </div>  	  
     </div>
  <div>
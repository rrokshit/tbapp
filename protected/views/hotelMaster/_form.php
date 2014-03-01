<div class="span12">
	   <div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
       <div class="box gradient">
         <div>
              <div class="title">
                 <h3>

                     <i class="icon-book"></i><span>Hotel Master<span class="botton_mergin"></span>
                        <span class=botton_margin1><a href="<?php echo Yii::app()->createUrl("HotelMaster/admin"); ?>" class="btn btn-success">Hotels</a></span>
                   </h3>
               </div>
           </div>
         <div class="content">
              <?php
             $form = $this->beginWidget('CActiveForm', array(
                 'id' => 'hotel-master-form',
                 'enableAjaxValidation' => false,
                    )); ?>         
                 
             <div class="form-row control-group row-fluid">
                   <div class="form-horizontal span6">
                        <div class="form-row control-group row-fluid fluid">
                            <?php echo $form->textField($model, 'name', array('size' => 50, 'maxlength' => 50, 'class' => 'span12', 'placeholder' => 'Hotel Name')); ?>
                            <?php echo $form->error($model, 'name'); ?>
                       </div>
                  </div>
				  
                     <div class="form-horizontal span6">
                         <div class="form-row control-group row-fluid fluid">
                             <?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30,  'class' => 'span8', 'placeholder' => 'Short Code')); ?>
                             <?php echo $form->error($model, 'short_code'); ?>  
                           </div>
                       </div>
             </div>      
              <div class="form-row control-group row-fluid"> 
                 <div class="form-horizontal span6">
                     <div class="form-row control-group row-fluid fluid">
                          <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 100,  'class' => 'span12', 'placeholder' => 'Address')); ?>
                          <?php echo $form->error($model, 'address'); ?>

                       </div>
                   </div>
	    	 </div>
              <div class="form-row control-group row-fluid">
                 <div class="form-horizontal span6">
                         <div class="form-row control-group row-fluid fluid">
                          <?php echo $form->textField($model, 'city', array('size' => 60, 'maxlength' => 200, 'class' => 'span6', 'placeholder' => 'City')); ?>
                          <?php echo $form->textField($model, 'state', array('size' => 60, 'maxlength' => 200, 'class' => 'span6', 'placeholder' => 'State')); ?>
                     </div>
                 </div> 
                 
                 <div class="form-horizontal span6">
                       <div class="form-row control-group row-fluid fluid">
                          <?php echo $form->textField($model, 'country', array('size' => 60, 'maxlength' => 200, 'class' => 'span8', 'placeholder' => 'Country')); ?>
                          <?php echo $form->error($model, 'country'); ?>

                      </div>
                  </div>
             </div>	 
			 
              <div class="form-row control-group row-fluid">
                 <div class="form-horizontal span6">
                     <div class="form-row control-group row-fluid fluid">
                          <?php echo $form->textField($model, 'phone', array('class' => 'span6', 'placeholder' => 'Phone No')); ?>
                          <?php echo $form->error($model, 'phone_no'); ?>

                      </div>
                  </div>
              
           <div class="form-row control-group row-fluid">
                  <div class="form-horizontal span6">
                     <div class="form-row control-group row-fluid fluid">
                          <?php echo $form->textField($model, 'website', array('size' => 60, 'maxlength' => 100, 'class' => 'span6', 'placeholder' => 'Web Site')); ?>                                           
                     </div>
                  </div>
			  
               <div class="form-row control-group row-fluid">
                  <label class="control-label span3">Hotel Rating
                    </label>
                   <div class="controls span7">
                    <label class="inline radio">
						<input type="radio" name="HotelMaster[rating]" value="1 Star" checked="<?php echo ($model->rating == '1 Star' ) ? 'true' : 'false' ;?>"/>1 Star
					</label>
					<label class="inline radio">
						<input type="radio" name="HotelMaster[rating]" value="2 Star" checked="<?php echo ($model->rating == '2 Star' ) ? 'true' : 'false' ;?>"/>2 Star
					</label>
					<label class="inline radio">
						<input type="radio" name="HotelMaster[rating]" value="3 Star" checked="<?php echo ($model->rating == '3 Star' ) ? 'true' : 'false' ;?>"/>3 Star
					</label>
					<label class="inline radio">
						<input type="radio" name="HotelMaster[rating]" value="4 Star" checked="<?php echo ($model->rating == '4 Star' ) ? 'true' : 'false' ;?>"/>4 Star
					</label>
					<label class="inline radio">
						<input type="radio" name="HotelMaster[rating]" value="5 Star" checked="<?php echo ($model->rating == '5 Star' ) ? 'true' : 'false' ;?>"/>5 Star
					</label>
					
                   </div>
             </div>
			 
              <div class="form-row control-group row-fluid">
                 <label class="control-label span3" for="inputEmail">Select Branch <span class="help-block"></span></label>
                  <div class="controls span7">
                      <?php 
							if($this->getAction()->getId() == 'create'){
								echo CHtml::activeDropDownList($model, 'branch_id_fk', $this->branches ,array('id'=>'slBranches'));
							}
							else{
								echo $this->updatedBranches;
							}
						?>

                   </div>
               </div>	
			   
			  <div class="form-row control-group row-fluid">
				  <div class="form-horizontal span6">
					  <div class="form-row control-group row-fluid fluid">
							  <?php echo $form->textarea($model, 'about_hotel', array('class' => 'span6', 'placeholder' => 'About Hotel', 'cols' => 100)); ?>                                           
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
   
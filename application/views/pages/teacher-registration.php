<h1><?php echo lang("site_teacher_registration_heading"); ?></h1>

<?php echo form_open('teacher-registration') ?>

<div class="formItem">
	<?php echo lang('site_label_email', 'email'); ?>
	<span class="formGroup">
		<span>
			<input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" />
		</span>
		<?php echo form_error('email'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_confirm_email', 'confirmEmail'); ?>
	<span class="formGroup">
		<span>
			<input type="text" id="confirmEmail" name="confirmEmail" value="<?php echo set_value('confirmEmail'); ?>" />
		</span>
		<?php echo form_error('confirmEmail'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_username', 'username'); ?>
	<span class="formGroup">
		<span>
			<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" />
		</span>
		<?php echo form_error('username'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_password', 'password'); ?>
	<span class="formGroup">
		<span>
			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
		</span>
		<?php echo form_error('password'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_confirm_password', 'confirmPassword'); ?>
	<span class="formGroup">
		<span>
			<input type="password" id="confirmPassword" name="confirmPassword" value="<?php echo set_value('confirmPassword'); ?>" />
		</span>
		<?php echo form_error('confirmPassword'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_name', 'fname'); ?>
	<span class="formGroup">
		<span class="firstName">
			<input type="text" value="<?php echo set_value('fname'); ?>" name="fname" placeholder="First name" />
		</span>
		<span class="surname">
			<input type="text" value="<?php echo set_value('surname'); ?>" name="surname" placeholder="Surname" />
		</span>
		<?php echo form_error('fname'); ?>
		<?php echo form_error('surname'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_contact_number', 'contactNumber'); ?>
	<span class="formGroup">
		<span>
			<input type="text" name="contactNumber" id="contactNumber" value="<?php echo set_value('contactNumber'); ?>" />
		</span>
		<?php echo form_error('contactNumber'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_date_of_birth', 'dob'); ?>
	<span class="formGroup">
		<span>
			<input type="text" id="dobPicker" name="dob" value="<?php echo set_value('dob'); ?>" placeholder="18/03/1986" />
		</span>
		<?php echo form_error('dob'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_ability', 'ability'); ?>
	<span class="formGroup">
		<span>
			<select name="ability">
				<option value="beginner" <?php echo set_select('ability', 'beginner'); ?> >Beginner</option>
				<option value="intermediate" <?php echo set_select('ability', 'intermediate'); ?> >Intermediate</option>
				<option value="advanced" <?php echo set_select('ability', 'advanced'); ?> >Advanced</option>
			</select>
		</span>
		<?php echo form_error('ability'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_availability', 'mondayFromTime'); ?>
	<span class="formGroup">
		<?php echo form_error('mondayFromTime'); ?>
		<?php echo form_error('mondayToTime'); ?>
		<span>
			<?php echo lang('site_label_availability', 'mondayFromTime'); ?>
			<input type="text" class="timePicker" name="mondayFromTime" value="<?php echo set_value('mondayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="mondayToTime" value="<?php echo set_value('mondayToTime'); ?>" />
			<input name="useForEntireWeek" id="useForEntireWeek" type="checkbox" value="1" <?php echo set_checkbox('useForEntireWeek[]', '1'); ?> /> <label for="useForEntireWeek">Use Monday time for entire week (this doesn't do anything at the moment, but other dates do default to Monday values if not set)</label>
		</span>
		<span>
			<?php echo lang('site_label_tuesday_to_time', 'tuesdayFromTime'); ?>
			<input type="text" class="timePicker" name="tuesdayFromTime" value="<?php echo set_value('tuesdayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="tuesdayToTime" value="<?php echo set_value('tuesdayToTime'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_wednesday_to_time', 'wednesdayFromTime'); ?>
			<input type="text" class="timePicker" name="wednesdayFromTime" value="<?php echo set_value('wednesdayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="wednesdayToTime" value="<?php echo set_value('wednesdayToTime'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_thursday_to_time', 'thursdayFromTime'); ?>
			<input type="text" class="timePicker" name="thursdayFromTime" value="<?php echo set_value('thursdayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="thursdayToTime" value="<?php echo set_value('thursdayToTime'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_friday_to_time', 'fridayFromTime'); ?>
			<input type="text" class="timePicker" name="fridayFromTime" value="<?php echo set_value('fridayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="fridayToTime" value="<?php echo set_value('fridayToTime'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_saturday_to_time', 'saturdayFromTime'); ?>
			<input type="text" class="timePicker" name="saturdayFromTime" value="<?php echo set_value('saturdayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="saturdayToTime" value="<?php echo set_value('saturdayToTime'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_sunday_to_time', 'sundayFromTime'); ?>
			<input type="text" class="timePicker" name="sundayFromTime" value="<?php echo set_value('sundayFromTime'); ?>" />
			<?php echo lang('site_label_to'); ?>
			<input type="text" class="timePicker" name="sundayToTime" value="<?php echo set_value('sundayToTime'); ?>" />
		</span>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_name_of_business', 'businessLocation'); ?>
	<span class="formGroup">
		<input type="text" class="businessLocation" name="businessLocation" value="<?php echo set_value('businessLocation'); ?>" />
		<?php echo form_error('businessLocation'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_location', 'houseNumber'); ?>
	<span class="formGroup">
		<span>
			<?php echo lang('site_label_address_line_1', 'addressLine1'); ?>
			<input type="text" id="addressLine1" name="addressLine1" value="<?php echo set_value('addressLine1'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_address_line_2', 'addressLine2'); ?>
			<input type="text" id="addressLine2" name="addressLine2" value="<?php echo set_value('addressLine2'); ?>" />
		</span>
		<span>
			<?php echo lang('site_label_address_city', 'addressCity'); ?>
			<input type="text" id="addressCity" name="addressCity" value="<?php echo set_value('addressCity'); ?>" />
		</span>
		<span>	
			<?php echo lang('site_label_postcode', 'postCode'); ?>
			<input type="text" id="postCode" class="postCode" name="postcode" value="<?php echo set_value('postcode'); ?>" />
		</span>
		<input type="hidden" value="<?php echo set_value('lat'); ?>" name="lat" id="lat" />
		<input type="hidden" value="<?php echo set_value('lng'); ?>" name="lng" id="lng" />
		<?php $latError = form_error('address'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_instrument', 'instrument'); ?>
	<span class="formGroup">
		<span>
			<select name="instrument" id="instrument">
				<?php foreach ($instruments->result_array() as $row) { $rowId = $row['id']; ?>
					<option value="<?php echo $row['id']; ?>" <?php echo set_select('instrument', $rowId); ?> ><?php echo $row['name']; ?></option>
				<?php }; ?>
			</select>
		</span>
		<?php echo form_error('instruments'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_cost', 'cost'); ?>
	<span class="formGroup">
		<span>
			<input type="text" name="cost" id="cost" value="<?php echo set_value('cost'); ?>" />
		</span>
		<?php echo form_error('cost'); ?>
	</span>
</div>

<div class="formItem">
	<?php echo lang('site_label_bio', 'bio'); ?>
	<span class="formGroup">
		<span>
			<textarea name="bio" id="bio"><?php echo set_value('bio'); ?></textarea>
		</span>
		<?php echo form_error('bio'); ?>
	</span>
</div>

<div class="formItem">
	<input type="submit" name="submit" value="<?php echo lang('site_btn_create_user'); ?>" /> 
</div>

<?php echo form_close(); ?>
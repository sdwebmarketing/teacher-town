<h1><?php echo lang("site_teacher_registration_heading"); ?></h1>

<?php echo form_open('users/add_user') ?>

<div class="formItem">
	<label for="email">Email:</label>
	<span class="formGroup">
		<span>
			<input type="text" id="email" name="email" />
		</span>
		<?php echo form_error('email'); ?>
	</span>
</div>

<div class="formItem">
	<label for="confirmEmail">Confirm email:</label>
	<span class="formGroup">
		<span>
			<input type="text" id="confirmEmail" name="confirmEmail" />
		</span>
		<?php echo form_error('confirmEmail'); ?>
	</span>
</div>

<div class="formItem">
	<label for="username">Username:</label>
	<span class="formGroup">
		<span>
			<input type="text" id="username" name="username" />
		</span>
		<?php echo form_error('username'); ?>
	</span>
</div>

<div class="formItem">
	<label for="password">Password:</label>
	<span class="formGroup">
		<span>
			<input type="password" id="password" name="password" />
		</span>
		<?php echo form_error('password'); ?>
	</span>
</div>

<div class="formItem">
	<label for="confirmPassword">Confirm Password:</label>
	<span class="formGroup">
		<span>
			<input type="password" id="confirmPassword" name="confirmPassword" />
		</span>
		<?php echo form_error('confirmPassword'); ?>
	</span>
</div>

<div class="formItem">
	<label for="title">Name:</label> 
	<span class="formGroup">
		<span class="firstName">
			<input type="input" value="" name="fname" placeholder="First name" />
		</span>
		<span class="surname">
			<input type="input" value="" name="surname" placeholder="Surname" />
		</span>
		<?php echo form_error('fname'); ?>
		<?php echo form_error('surname'); ?>
	</span>
</div>

<div class="formItem">
	<label for="text">Date of Birth:</label>
	<span class="formGroup">
		<span>
			<input type="text" id="dobPicker" name="dob" placeholder="18/03/1986" />
		</span>
		<?php echo form_error('dob'); ?>
	</span>
</div>

<div class="formItem">
	<label for="ability">Ability:</label>
	<span class="formGroup">
		<span>
			<select name="ability">
				<option value="beginner">Beginner</option>
				<option value="intermediate">Intermediate</option>
				<option value="advanced">Advanced</option>
			</select>
		</span>
		<?php echo form_error('ability'); ?>
	</span>
</div>

<div class="formItem">
	<label>Availability:</label>
	<span class="formGroup">
		<?php echo form_error('mondayFromTime'); ?>
		<?php echo form_error('mondayToTime'); ?>
		<span>
			<label for="mondayFromTime">Monday:</label>
			<input type="text" class="timePicker" name="mondayFromTime" />
			to
			<input type="text" class="timePicker" name="mondayToTime" />
			<input name="useForEntireWeek" id="useForEntireWeek" type="checkbox" /> <label for="useForEntireWeek">Use Monday time for entire week (this doesn't do anything at the moment, but other dates do default to Monday values if not set)</label>
		</span>
		<span>
			<label for="tuesdayFromTime">Tuesday:</label>
			<input type="text" class="timePicker" name="tuesdayFromTime" />
			to
			<input type="text" class="timePicker" name="tuesdayToTime" />
		</span>
		<span>
			<label for="wednesdayFromTime">Wednesday:</label>
			<input type="text" class="timePicker" name="wednesdayFromTime" />
			to
			<input type="text" class="timePicker" name="wednesdayToTime" />
		</span>
		<span>
			<label for="thursdayFromTime">Thursday:</label>
			<input type="text" class="timePicker" name="thursdayFromTime" />
			to
			<input type="text" class="timePicker" name="thursdayToTime" />
		</span>
		<span>
			<label for="fridayFromTime">Friday:</label>
			<input type="text" class="timePicker" name="fridayFromTime" />
			to
			<input type="text" class="timePicker" name="fridayToTime" />
		</span>
		<span>
			<label for="saturdayFromTime">Saturday:</label>
			<input type="text" class="timePicker" name="saturdayFromTime" />
			to
			<input type="text" class="timePicker" name="saturdayToTime" />
		</span>
		<span>
			<label for="sundayFromTime">Sunday:</label>
			<input type="text" class="timePicker" name="sundayFromTime" />
			to
			<input type="text" class="timePicker" name="sundayToTime" />
		</span>
	</span>
</div>

<div class="formItem">
	<label for="businessLocation">Name of Business:</label>
	<span class="formGroup">
		<input type="text" class="businessLocation" name="businessLocation" />
		<?php echo form_error('businessLocation'); ?>
	</span>
</div>

<div class="formItem">
	<label for="houseNumber">Location:</label>
	<span class="formGroup">
		<span>
			<label for="houseNumber">House number:</label>
			<input type="text" value="" id="houseNumber" name="houseNumber" />
			<label for="postCode">Postcode:</label>
			<input type="text" value="" id="postCode" class="postCode" name="postcode" />
			<input type="button" value="Find postcode" class="postCodeFindSubmit" />
			<div id="addressResult">
				<select onclick='if($.browser.msie && $.browser.version=="6.0") alert("Thanks. Your address selection will now be populated into the order form."); $("#address").val(info[this.value].address); $("#city").val(info[this.value].town); $("#county").val(info[this.value].county); $("#postcode").val(info[this.value].postcode);' class="addressChoices" id="addressResults"></select>
			</div>
			<textarea class="hidden" disabled="disabled" id="resultSelected"></textarea>
			<button class="hidden" id="useAddress">Use selected address</button>
			<input type="hidden" name="address" id="address" />
			<input type="hidden" name="lat" id="lat" />
			<input type="hidden" name="lng" id="lng" />
		</span>
		<?php $latError = form_error('address'); ?>
	</span>
</div>

<div class="formItem">
	<label for="instrument">Which instrument/s do you specialise in?:</label>
	<span class="formGroup">
		<span>
			<select name="instrument" id="instrument">
				<?php foreach ($instruments->result_array() as $row) { ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
				<?php }; ?>
			</select>
		</span>
		<?php echo form_error('instruments'); ?>
	</span>
</div>

<div class="formItem">
	<label for="bio">Bio (what makes you different?):</label>
	<span class="formGroup">
		<span>
			<textarea name="bio" id="bio"></textarea>
		</span>
		<?php echo form_error('bio'); ?>
	</span>
</div>

<div class="formItem">
	<input type="submit" name="submit" value="Create dummy user" /> 
</div>

</form>
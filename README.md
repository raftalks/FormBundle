# Form Maker

Form Maker can help buildind forms in PHP. 
Basic syntax is to think that the first method called creates an element tag and nested methods creates attributes. There are other simple ways to do a lot more with this library.

#Updated to version 1.2.0
###Change Log
- Added Support to create Macros
- Added Support to create global Html Tag Decorator
- Added Support to include Template structure for advanced UI interface

###Upgrade from version 1.0.0
- Download the updates using Artisan bundle update command 
```
php artisan bundle:upgrade formbundle
```

## To Use with Laravel 3
Install via Artisan Bundle Install command
```
php artisan bundle:install FormBundle
```
Now we need to put the class Alias inside L3 application/config/application.php file.
Find the aliases key and put the following inside its array.

If you do not need to use core Form class you can comment out and put the following line
```php
	//'Form'       	=> 'Laravel\\Form', <- commented out the core Form class
	  'Form'	 	=> 'Form\\Form',
```

If you consider to use core Laravel Form, then you can give any name for the class alias. For example:
```php
	'Form'       	=> 'Laravel\\Form', //core Form class available
	'XForm'	 		=> 'Form\\Form', 
```
However, if you change the alias, you will need to call that class Alias instead of calling to Form.
```
  XForm::make(function($form){ ...do what u want...}); //calling alias class
```

Now you can try using the Form::make(function($form){ ...here you can put the form fields ...});


#Features
Following shows you how this package library is used to make forms.

##Additional Features added to version 1.2.0

```php
//globaly apply attributes to tag elements
	
	//apply attribute to all text input fields
	Form::decorate('text',function($tag)
	{		
		$tag->class('class decorated');
	});


//Create Form Macros with template

	//bootstrap controlgroup textfield
	Form::macro('group_text',function($name, $label=null)
	{
		return Form::template('div',function($form) use($name, $label)
		{
			$form->label($label)->class('control-label');

			$form->div(function($form) use($name)
			{
				$form->text($name);
				$form->setClass('controls');
			});

			$form->setClass('group-controls');
		});

	});

	//the above Macro is now available as a Form field type and can be called within a Form 
	
	Form::make(function($form))
	{
		$form->group_text('telephone','Telephone Number');
	}

	//The above will result the following html code
	/**
	<div class="group-controls">
		<label class="control-label">Telephone Number</label>
		<div class="controls">
			<input name="telephone" type="text">
		</div>
	</div>
	*/

// will include more use cases later

```
###version 1.0.0 features
```php
echo Form::make(function($form)
{
		$form->div(function($form){ //makes a div container for the enclosed fields

			//creates a text input with label
			$form->text('username','User Name')->class('myname')->value('some name');  

			//creates a password input with label
			$form->password('password','Enter Password');

			$form->select('usergroup','User Group')->options(array('admin'=>'admin','manager'=>'manager','user'=>'user'),
									 array('user','admin'))->multiple('multiple');

			$form->setClass('input'); //sets container class
			$form->setId('UserAccount'); //sets container id
		});

		// creates an custom tag element like <group>dome</group> 
		$form->group('dome'); 

		//creates a fieldset container <fieldset></fieldset> and enclose the fields in it
		$form->fieldset(function($form) 
		{
			$form->legend('HelloWOrld');

			$form->label('Your Address')->for('address'); //create label field separately
			$form->text('address');
		});
		
		//create Angularjs type input
		$form->text('timer','Time')->ngmodel('time','ng-model');
		$form->select('countries','select country')->ngrepeat('country.name in countries','ng-repeat');

		$form->submit('Save');
		
		//sets container attributes, therefore, as this is form container, this sets the form attributes
		$form->setId('formIDhere');
		$form->setAction(URL::to('test'));
		$form->setMethod('POST');
		$form->setClass('fill-up');

});

```


## Documentation

will be updated soon.


## Copyright and License
FormMaker was written by Raftalks for the Laravel framework.
FormMaker is released under the MIT License. See the LICENSE file for details.

Copyright 2011-2012 Raftalks
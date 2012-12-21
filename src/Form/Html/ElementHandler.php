<?php
namespace Form\Html;

class ElementHandler
{
	protected $element;
	protected $type;
	protected $originType;

	public function __construct(HtmlTag $element)
	{
		$this->element = $element;
		$this->type = $element->getTagName();
		$this->originType = $element->getOriginType();
	}


	public function setAttribute($name, $value=null, $extra = null)
	{
		if($name == 'options')
		{
			$this->addOptionsToSelect($name, $value, $extra);

		}
		else
		{
			
			$this->element->setAttribute($name, $value);
		}

		return $this;
	}


	public function addChildren(HtmlTag $child)
	{
		$this->element->addTag($child);
		return $this;
	}


	public function addOptionsToSelect($name, $value, $selected)
	{
		$options = $value;
		$tags = array();

		if(!is_array($selected))
		{
			$selected = array($selected);
		}

		if(is_array($options))
		{
			$originType = 'option';

			foreach($options as $val => $label)
			{

				$tag = $this->newElementInstance('option', $originType);
				
				if(in_array($val, $selected))
				{
					$tag->setAttribute('selected','selected');
				}

				$tag->addText($label);
				$this->addChildren($tag);

			}
		}
		

	}


	protected function newElementInstance($tag, $originType)
	{
		return new HtmlTag($tag, $originType);
	}


	public function __call($method, $args)
	{

		$value = $args[0];
		$name = $method;
		$extra = null;
		if(isset($args[1]))
		{
			if($method !== 'options')
			{
				$name = $args[1];
			}else
			{
				$extra = $args[1];
			}
		}
		return $this->setAttribute($name, $value, $extra);
	}

}
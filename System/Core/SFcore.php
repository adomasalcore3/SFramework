<?php

function & get_instance()
{
	return SF_Core::get_instance();
}
function & set_instance($i)
{
	SF_Core::save_instance($i);
}
function & clear_instance()
{
	SF_Core::clear_instance();
}
function SF_debug()
{
	SF_Core::$debug_mode=SF_Debug;
}
/*
** SF_debug CALL:
** says if the core debug is activated or not...
** if yes (On the core config file), all the debug log from the core will be
** printed.
*/
SF_debug();
/*
** Initiation of the core
*/
class SF_Core
{
	private static $instance;
	public static $debug_mode=false;
	function debug($r)
	{
		if(self::$debug_mode==TRUE)
		{
			print_r($r);
			print_r('<br>');
		}
	}
	function __construct()
	{
		$this->debug('SF_CORE init');
		if(self::$instance==null)
		{
			//initiation
			$this->load=new load();
		}
		else
		{
			$this->debug('SF_CORE already initiated... continuing...');
		}
	}
	public static function & get_instance() {
	  $class = new static();

		if ( ! self::$instance instanceof $class) {
			self::$instance = new $class;
			self::$instance->debug('created new singleton instance');
			if ( ! self::$instance instanceof $class)
			{
				self::$instance->debug('singleton instance error on get?');
			}
		}
		else
		{
			self::$instance->debug('returned singleton instance');
		}

		return self::$instance;
	}
	static function save_instance($instance)
	{
		$class = new static();
		if ( ! self::$instance instanceof $class) {
		 self::$instance = new $class;
		self::$instance->debug('created singleton instance');
	  }
	  else
	  {
		self::$instance=$instance;
		self::$instance->debug('saved singleton instance');
	  }
	}
	static function clear_instance()
	{
		if(self::$instance!=null)
		{
			self::$instance=null;
		}
	}
	function define($n,$c)
	{
		if(!defined($n))
		{
			define($n,$c);
		}
	}
}
class load
{
	/*
	**gets the global debug mode
	*/
	private $__debug;
	function __construct()
	{
		$this->__debug=SF_Core::$debug_mode;
		$this->debug('loaded Load');
	}
	private function debug($r)
	{
		if($this->__debug==TRUE)
		{
			print_r($r);
			print_r('<br>');
		}
	}
	function __class($cn)
	{
		$this->debug('loading class:'.$cn);
		$dir=Sys.'/Core/'.$cn.'.php';
		if(file_exists($dir))
		{
			$this->debug('class '.$cn.' loaded');
			require_once($dir);
			$parent=&get_instance();
			$cln=strtolower($cn);
			$parent->$cln=new $cn;
			$parent::save_instance($parent);
		}	
		else
		{
			$this->debug('class '.$cn.' wasn\'t loaded because file does not exists');
		}
	}
	function __functions($func)
	{
		$this->debug('loading function group:'.$cn);
		$dir=Sys_PTH.'/functions_groups/'.$cn.'.php';
		if(file_exists($dir))
		{
			$this->debug('function group '.$cn.' loaded');
			require_once($dir);
		}
		else
		{
			$this->debug('function group file '.$cn.' wasn\'t loaded because file does not exists');
		}
	}
}

class unload
{
	/*
	**gets the global debug mode
	*/
	private $__debug;
	function __construct()
	{
		$this->__debug=SFcore::$debug_mode;
		$this->debug('loaded Load');
	}
	private function debug($r)
	{
		if($this->__debug==TRUE)
		{
			print_r($r);
			print_r('<br>');
		}
	}
	function __class($cn)
	{
		$this->debug('unloading class:'.$cn);
		$parent=&get_instance();
		$cln=strtolower($cn);
		if(($cln!='load') && ($cln!='unload') && isset($parent->$cln) && is_object($parent->$cln) && is_a($parent->$cln,$cln))
		{
			$parent->$cln=null;
			$parent::save_instance($parent);
		}
		elseif(isset($parent->$cln) && !is_object($parent->$cln) )
		{
			$this->debug(''.$cn.' is not an Class');
		}
		elseif(!isset($parent->$cln))
		{
			$this->debug(''.$cn.' Class doesn\'t had been instanciate!');
		}
		elseif(($cln=='load')||($cln=='unload'))
		{
			$this->debug('class '.$cn.'Cannot Be unloaded since it is part of the system!');
		}
		else
		{
			$this->debug('class '.$cn.'??? where are you?');
		}
	}
}
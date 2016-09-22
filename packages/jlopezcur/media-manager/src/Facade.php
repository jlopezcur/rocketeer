<?php

namespace Jlopezcur\MediaManager;

class Facade extends \Illuminate\Support\Facades\Facade {

	protected static function getFacadeAccessor()
	{
		return 'Jlopezcur\MediaManager\Helpers';
	}

}

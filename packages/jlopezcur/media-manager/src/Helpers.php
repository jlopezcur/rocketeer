<?php

namespace Jlopezcur\MediaManager;

class Helpers {

	// private $url;

	public function __construct() {

	}

	public function script() {
		$out = '<link href="' . asset('assets/plugins/mediamanager/mediamanager.css') . '" rel="stylesheet">';
		$out .= '<script src="' . asset('assets/plugins/mediamanager/mediamanager.js') . '" type="text/javascript"></script>';
		$out .= '<script src="' . asset('assets/plugins/dropzone/dropzone.js') . '" type="text/javascript"></script>';
		$out .= '<script type="text/javascript">
		$(function () {
		    $(\'.mediamanager\').mediamanager({
		        serviceGet: \'' . route('mediamanager.get') . '/\',
		        serviceUpload: \'' . route('mediamanager.upload') . '\',
		        serviceNewFolder: \'' . route('mediamanager.newfolder') . '\',
		        serviceDelete: \'' . route('mediamanager.delete') . '\',
		        noImage: \'' . asset('img/empty.png') . '\',
		        translationTitle: \'' . trans('mediamanager::mediamanager.mediamanager') . '\',
		        translationSearch: \'' . trans('mediamanager::mediamanager.search') . '...\',
		        translationClose: \'' . trans('mediamanager::mediamanager.close') . '\',
		        translationUseUri: \'' . trans('mediamanager::mediamanager.use_uri') . '\',
		        translationClearUri: \'' . trans('mediamanager::mediamanager.clear_uri') . '\',
		        translationDropHere: \'' . trans('mediamanager::mediamanager.drop_here') . '\'
		    });
		});
		</script>';
		return $out;

	}

}

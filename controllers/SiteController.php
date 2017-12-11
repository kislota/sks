<?php

class SiteController extends Controller{

	public function actionIndex()
	{
		require_once(ROOT . '/views/site/index.php');
		return true;
	}
        
        
	public function actionView()
	{
          echo 'Метод View';  
	//	require_once(ROOT . '/views/site/index.php');
		return true;
	}
}


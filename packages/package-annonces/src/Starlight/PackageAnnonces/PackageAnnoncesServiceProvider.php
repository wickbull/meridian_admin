<?php namespace Starlight\PackageAnnonces;

use App\Traits\Translatable;
use Packages;

class PackageAnnoncesServiceProvider extends \Starlight\Kernel\Packages\AbstractServiceProvider {

	/**
	 * @var boolean
	 */
	protected $migrations = true;

	/**
	 * @var array
	 */
	protected $controllers = ['PackageAnnoncesController'];

	/**
	 * @var array
	 */
	protected $models = ['Annonce', 'AnnonceTranslation'];

	/**
	 * @return void
	 */
	public function init()
	{
		$this->addSidebarControl('package-annonces', '\Packages\PackageAnnoncesController@getList', [
			'title' => _('Annonces'),
			'icon' => 'bullhorn',
		]);

		$this->registerInjectTpl(['UsersMaterialsTab'], 'package-annonces::inject.tab', function ($entity)
		{
			return ['user' => $entity];
		});

		$this->registerInjectTpl(['UsersMaterialsTabContent'], 'package-annonces::inject.tab-content', function ($entity)
		{
			return ['user' => $entity];
		});

	}

}

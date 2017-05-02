<?php namespace Starlight\PackageAnnonces\Models;


class AnnonceTranslation extends \Starlight\Kernel\Packages\AbstractModel {

	public $table = 'annonces_translations';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'slug',
		'subtitle',
		'body',
		'is_active',
	];

}

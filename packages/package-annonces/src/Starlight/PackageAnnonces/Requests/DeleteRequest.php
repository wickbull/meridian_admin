<?php namespace Starlight\PackageAnnonces\Requests;

class DeleteRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['AnnonceDelete'];

	/**
	 * @return array
	 */
	public function rules()
	{
		return [];
	}

}

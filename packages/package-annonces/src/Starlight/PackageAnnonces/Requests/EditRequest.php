<?php namespace Starlight\PackageAnnonces\Requests;

class EditRequest extends \Starlight\Kernel\Requests\Request {

	/**
	 * @var array
	 */
	protected $inject_rules = ['NewsEdit'];

	/**
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route()->parameter('annonces')->id;

		return [
			'title' => 'required|max:255',
			'slug'  => "required",
			'image_storage_id' => 'integer|exists:generic_files,id',
			'subtitle' => 'max:255',
			'body' => '',
			'author' => '',
			'is_active' => 'required|in:1,0',
			'is_top' => 'required|in:1,0',
			'event_at' => '',
		];
	}

}

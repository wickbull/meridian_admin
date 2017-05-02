<li role="presentation" class="js-container-loader" data-container=".js-annonces-materials-container" data-url="{{ action('\Packages\PackageAnnoncesController@getNewsByUser', $user) }}">
	<a href="#annonces" aria-controls="annonces" role="tab" data-toggle="tab">{{ _('Annonces') }}</a>
</li>

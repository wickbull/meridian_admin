<?php namespace Starlight\PackageAnnonces\Controllers;

use Starlight\PackageAnnonces\Requests;
use Input;
use Packages;
use Illuminate\Support\Facades\App;

class PackageAnnoncesController extends \Starlight\Kernel\Packages\AbstractController {

    /**
     * @return Response
     */
    public function getList()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);

        if (Input::has('q')) {
            $annonces = Packages\Annonce::translatedIn($lang)->whereTranslationLike('title', '%' . Input::get('q'). '%')->orderBy('event_at', 'DESC')->paginate(15);
        } else {
            $annonces = Packages\Annonce::translatedIn($lang)->orderBy('event_at', 'DESC')->paginate(15);
        }

        return view('package-annonces::list', [
            'annonces' => $annonces
        ]);
    }

    /**
     * @return Response
     */
    public function getAdd()
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);
        $front_preview_url = env('FRONT_PREVIEW_PUBLICATION_URL', '');

        return view('package-annonces::add', [
            'front_preview_url' => $front_preview_url,
            'lang' => $lang
        ]);
    }

    /**
     * @param  Requests\AddRequest $request
     * @return Response
     */
    public function postAdd(Requests\AddRequest $request)
    {
        $lang = $request->get('lang');
        App::make('config')->set('translatable.locale', $lang);

        $news = new \Packages\Annonce($request->allWithRules());
        $news->creator_id = \Auth::user()->id;
        $news->editor_id = \Auth::user()->id;
        $news->save();

        $this->handleInjected([
                'PublicationsAdd',
                'AnnoncesAdd',
                'StatusesAdd',
                'TagsAdd',
                'LecturersAdd',
                'ChairsAdd',
                'LaboratoriesAdd',
                'AnnoncesCategoryAdd',
                'StoragableAdd',
                'GalleriableAdd'
            ], $news, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageAnnoncesController@getEdit', [$news, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('Annonce created successfully')]);
        }

        return redirect(action('\Packages\PackageAnnoncesController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('Annonce created successfully')]);
    }

    /**
     * @param  Packages\News $news
     * @return Response
     */
    public function getEdit(Packages\Annonce $annonces)
    {
        $lang = Input::get('lang');
        App::make('config')->set('translatable.locale', $lang);
        $front_preview_url = env('FRONT_PREVIEW_PUBLICATION_URL', '');

        return view('package-annonces::edit', [
            'front_preview_url' => $front_preview_url,
            'annonces' => $annonces,
            'lang' => $lang
        ]);
    }

    /**
     * @param  Packages\Annonce       $annonces
     * @param  Requests\EditRequest  $request
     * @return Response
     */
    public function postEdit(Packages\Annonce $annonces, Requests\EditRequest $request)
    {
        $lang = $request->get('lang');

        App::make('config')->set('translatable.locale', $lang);
        $annonces->fill($request->allWithRules());
        $annonces->editor_id = \Auth::user()->id;

        if(!$annonces->creator_id){
            $annonces->creator_id = \Auth::user()->id;
        }

        $annonces->save();

        $this->handleInjected([
                'PublicationsEdit',
                'AnnoncesEdit',
                'StatusesEdit',
                'TagsEdit',
                'ChairsEdit',
                'LecturersEdit',
                'LaboratoriesEdit',
                'AnnoncesCategoryEdit',
                'StoragableEdit',
                'GalleriableEdit'
            ], $annonces, $request);

        if($request->input('next_action') == 'save'){
            return redirect(action('\Packages\PackageAnnoncesController@getEdit', [$annonces, 'lang' => $lang ?: 'uk']))
                ->withMessagesSuccess([_('Annonce saved successfully')]);
        }

        return redirect(action('\Packages\PackageAnnoncesController@getList', ['lang' => $lang ?: 'uk']))
            ->withMessagesSuccess([_('Annonce saved successfully')]);

    }


    /**
     * @param
     * @return Response
     */
    public function deleteDelete(Packages\Annonce $annonces, Requests\DeleteRequest $request)
    {
        $this->handleInjected([
                'PublicationsDelete',
                'NewsDelete',
                'ChairsDelete',
                'LecturersDelete',
                'LaboratoriesDelete'
            ], $annonces, $request);

        $annonces->delete();

        return redirect(action('\Packages\PackageAnnoncesController@getList'))
            ->withMessagesSuccess([_('News deleted successfully')]);
        ;
    }

    /**
     * @return array
     */
    public function getCheckSlug()
    {
        return [
            'slug' => Input::get('slug'),
            'exists' => 0
        ];
    }

    /**
     * @return array
     */
    public function getNewsByUser(Packages\User $user)
    {
        $annonces = Packages\Annonce::whereCreatorId($user->id)
            ->ordered()
            ->with(['creator'])
            ->paginate(15);

        return view('package-annonces::inject.table-inject', [
            'annonces' => $annonces,
            'user' => $user
        ]);
    }


}

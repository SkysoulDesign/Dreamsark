<?php

namespace DreamsArk\Http\Controllers\Translation;

use DreamsArk\Commands\Translation\ExportTranslationCommand;
use DreamsArk\Commands\Translation\ImportTranslationCommand;
use DreamsArk\Commands\Translation\UpdateTranslationCommand;
use DreamsArk\Models\Translation\Translation;
use DreamsArk\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Http\Request;
use DreamsArk\Http\Requests;
use DreamsArk\Http\Controllers\Controller;

class TranslationController extends Controller
{
    /**
     * @var TranslationRepositoryInterface
     */
    private $repository;

    public function __construct(TranslationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $language
     * @param string $group
     * @return \Illuminate\Http\Response
     */
    public function index($language = 'all', $group = 'all')
    {

        $translations = $this->repository->where(compact('language', 'group'));

        $groups = $this->repository->groups();
        $languages = $this->repository->languages();

        return view('translation.index', compact('translations', 'groups', 'languages'));

    }

    /**
     * Update Language
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param Translation $translation
     */
    public function update($id, Request $request)
    {
        $command = new UpdateTranslationCommand($id, $request->all());
        $status = $this->dispatch($command);

        return response()->json(compact('status'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {

        $command = new ImportTranslationCommand();
        $this->dispatch($command);

        return redirect()->back();

    }

    /**
     * Export Translations
     * @return \Illuminate\Http\Response
     * @internal param Translation $translation
     */
    public function export()
    {

        $command = new ExportTranslationCommand();
        $this->dispatch($command);

        return redirect()->back();
    }

    /**
     * Create a new Language
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param Translation $translation
     */
    public function newLanguage(Request $request)
    {
        dd($request->all());
        return redirect()->back();
    }

    /**
     * Create a new Group
     *
     * @return \Illuminate\Http\Response
     * @internal param Translation $translation
     */
    public function newGroup()
    {
        return redirect()->back();
    }

    /**
     * Create New Language Key
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newKey(Request $request)
    {
        dd($request->all());
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\Utilities\Country;
use App\Utilities\Flash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;

/**
 * Class FlyersController
 * @package App\Http\Controllers
 */
class FlyersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Country $country
     * @return mixed
     */
    public function create(Country $country)
    {
        return view('flyers.create')->withCountries($country->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\FlyerRequest $request
     * @param Flash $flash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\FlyerRequest $request, Flash $flash)
    {
        $flyer = Flyer::create($request->all());

        $flash->message('Success', 'Flyer was successfully created');

        return redirect()->route('flyers.show', [$flyer->zip, $flyer->street]);
    }

    /**
     * Display the specified resource.
     *
     * @param $zip
     * @param $street
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street)->firstOrFail();

        return view('flyers.show', compact('flyer'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function addPhoto(Request $request, Flyer $flyer)
    {
        $request->validate([
            'photo' => 'required|image'
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        $flyer->addPhoto($photo);
    }

    /**
     * Make photo for flyer.
     *
     * @param UploadedFile $file
     * @return Photo
     */
    public function makePhoto(UploadedFile $file)
    {
        return Photo::withName($file->getClientOriginalName())
            ->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

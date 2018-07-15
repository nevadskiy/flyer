<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Utilities\Country;
use App\Utilities\Flash;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class FlyersController
 * @package App\Http\Controllers
 */
class FlyersController extends Controller
{
    /**
     * FlyersController constructor.
     */
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
        $flyer = auth()->user()->publish(
            new Flyer($request->all())
        );

        $flash->message('Success', 'Flyer was successfully created');

        return redirect(flyer_path($flyer));
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

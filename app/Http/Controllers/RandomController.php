<?php

namespace App\Http\Controllers;

use App\Models\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RandomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $randoms = Random::with('breakdown')->paginate(1, ['*'], 'random');
        //dd($randoms);
        return view('welcome')->with(compact('randoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* generate random values */
        for ($i = 0; $i < rand(5, 10); $i++) {
            /* generate random name with length of 15 */
            $randomCreated = Random::create([
                'values' => Str::random(15),
            ]);
            
            for ($k = 0; $k < rand(5, 10); $k++) {
                /* generate random breakdown value with length of 5 */
                $breakdownCreated = $randomCreated->breakdown()->create([
                    'values' => Str::random(5),
                ]);
            }
        }

        return redirect()->back();
    }
}

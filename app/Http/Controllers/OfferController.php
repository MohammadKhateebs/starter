<?php

namespace App\Http\Controllers;

use App\Events\OfferViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;

use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
use OfferTrait;

    public function store(OfferRequest $request)
    {
        $file_name = $this->saveImage($request->photo, 'imegs/offers');

        Offer::create([
            "name" => $request->name,
            "photo" => $file_name,
            "price" => $request->price,
        ]);
        return redirect()->back()->with(['succ' => __('message.Offer Add Done')]);

    }


    public function create()
    {

        return view('offers.offer');
    }

    public function getAllOffer()
    {
        $offers = Offer::select('id', 'name', 'price', 'photo')->get();

        return view('offers.alloffer', compact('offers'));
    }

    public function delete($id)
    {

        Offer::find($id)->delete();

        return redirect()->back()->with(['valid' => __('message.Offer Delete Done')]);

    }

    public function edit($id_offer)
    {
        //  Offer::findOrFail($id_offer);
        $offer = Offer::find($id_offer);
        if (!$offer) return redirect()->back();
        $offer = Offer::select('id', 'name', 'price', 'viewer')->find($id_offer);
        event(new OfferViewer($offer));
        return view('offers.edit', compact('offer'));

    }

    public function update(OfferRequest $request, $id_offer)
    {

        $offer = Offer::find($id_offer);
        if (!$offer) return redirect()->back();
        $offer->update($request->all());
        return redirect()->back()->with(['succ' => __('message.Offer Edit Done')]);
    }


}

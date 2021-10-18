<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{

    public function store(OfferRequest $request)
    {

        Offer::create([
            "name" => $request->name,
            "price" => $request->price,
        ]);
        return redirect()->back()->with(['succ' => __('message.Offer Add Done')]);

    }

    public function create()
    {

        return view('offers.offer');
    }
    public function getAllOffer(){
        $offers=Offer::select('id','name','price')->get();

        return view('offers.alloffer',compact('offers'));
    }

    public function edit($id_offer){
      //  Offer::findOrFail($id_offer);
        $offer=Offer::find($id_offer);
        if(!$offer) return redirect()->back();
        $offer=Offer::select('id','name','price')->find($id_offer);
        return view('offers.edit',compact('offer'));

    }
    public function update(OfferRequest $request,$id_offer){

        $offer=Offer::find($id_offer);
        if(!$offer) return redirect()->back();

        $offer->update($request->all());
 return  redirect()->back()->with(['succ' => __('message.Offer Edit Done')]);
    }
}

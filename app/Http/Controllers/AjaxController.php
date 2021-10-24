<?php

namespace App\Http\Controllers;

use App\Events\OfferViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;

use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use OfferTrait;

    public function create()
    {
        return view('ajaxoffer.offer');
    }

    public function store(OfferRequest $request)
    {
        //save photo folder
        $file_name = $this->saveImage($request->photo, 'imegs/offers');


        $offer = Offer::create([
            "name" => $request->name,
            "photo" => $file_name,
            "price" => $request->price,
        ]);
        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم حفظ بنجاح'
            ]);
        else    return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ'
        ]);
    }

    public function getAllOffer()
    {
        $offers = Offer::select('id', 'name', 'price', 'photo')->get();

        return view('ajaxoffer.alloffer', compact('offers'));
    }

    public function delete(Request $request)
    {

        Offer::find($request->id)->delete();

        return response()->json([

            'status' => true,
            'msg' => __('message.Offer Delete Done'),
            'id' => $request->id,
        ]);
    }

    public function edit($id_offer)
    {
        //  Offer::findOrFail($id_offer);
        $offer = Offer::find($id_offer);
        if (!$offer) return response()->json();
        $offer = Offer::select('id', 'name', 'price', 'viewer')->find($id_offer);
        event(new OfferViewer($offer));
        return view('ajaxoffer.edit', compact('offer'));

    }

    public function update(Request $request)
    {

        $offer = Offer::find($request->id);
        if (!$offer)  return response()->json(['404']);
        $offer->update($request->all());
        return response()->json(['succ' => __('message.Offer Edit Done')]);
    }


}

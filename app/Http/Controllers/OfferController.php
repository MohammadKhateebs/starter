<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{

    public function store(Request $request)
    {
        $message = $this->getMessage();
        $ruls = $this->getRuls();
        $validator = Validator::make($request->all(), $ruls, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Offer::create([
            "name" => $request->name,
            "price" => $request->price,
        ]);
        return redirect()->back()->with(['succ'=>'تم ادراد الاوفر']);

    }

    public function create()
    {

        return view('offers.offer');
    }


    protected function getMessage()
    {
        return $message = [
            'name.required' => 'الاسم مطلوب',
            'price.required' =>'السعر مطلوب',

        ];
    }

    protected function getRuls()
    {
        return $ruls = [
            'name' => 'required',
            'price' => 'required',

        ];

    }

}

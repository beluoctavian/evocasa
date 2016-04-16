<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use App\Customer;

class CustomersController extends Controller {

	public function getCustomers() {
        if(Auth::guest())
            return redirect('/');
        $gets = Input::get();
        $nume = isset($gets["nume"]) ? $gets["nume"] : null;
        $telefon = isset($gets["telefon"]) ? $gets["telefon"] : null;
        $camere = isset($gets["camere"]) ? strtolower($gets["camere"]) : null;
        $buget_minim = isset($gets["buget_minim"]) ? $gets["buget_minim"] : 0;
        $buget_maxim = isset($gets["buget_maxim"]) ? $gets["buget_maxim"] : 1500000;
        $cartier = isset($gets["cartier"]) ? $gets["cartier"] : null;
        $sortare = (isset($gets["sort"]) && $gets["sort"] == "buget") ? $gets["sort"] : "id";
        $tip_sortare = (isset($gets["tip_sortare"]) && $gets["tip_sortare"] == "asc") ? $gets["tip_sortare"] : "desc";

        $customers = Customer::
            whereRaw("(nume LIKE " . "'%".$nume."%'" . " OR prenume LIKE " . "'%".$nume."%')")
            ->whereRaw("(buget >= " . $buget_minim . " AND buget <= " . $buget_maxim .")")
            ->where('telefon', 'LIKE', '%'.$telefon.'%')
            ->where('numar_camere_cautate', 'LIKE', '%'.$camere.'%')
            ->where('cartier', 'LIKE', '%'.$cartier.'%')
            ->orderBy($sortare, $tip_sortare)
            ->get();
        $page = Input::get('page');
        if(!$page)
            $page = 1;
        return view('customers.show')->with('customers', $customers)->with('page',$page);
    }
    public function editCustomer($id) {
        if(Auth::guest())
            return redirect('/');
        $customer = Customer::find($id);
        return view('customers.edit')->with('customer',$customer);
    }
    public function postEditCustomer(Request $request) {
        if(Auth::guest())
            return redirect('/');
        Customer::find($request->id)->update([
            'nume' => $request->nume,
            'prenume' => $request->prenume,
            'telefon' => $request->telefon,
            'email' => $request->email,
            'buget' => $request->buget,
            'tip_plata' => $request->tip_plata,
            'numar_camere_cautate' => $request->numar_camere_cautate,
            'oras' => $request->oras,
            'cartier' => $request->cartier,
            'zona' => $request->zona,
            'observatii' => $request->observatii
        ]);
        $customer = Customer::find($request->id);
        return view('customers.edit')->with('customer',$customer)->with('success',1);
    }
    public function addCustomer(Request $request) {
        if(Auth::guest())
            return redirect('/');
        $customer = Customer::create([
            'nume' => $request->nume,
            'prenume' => $request->prenume,
            'telefon' => $request->telefon,
            'email' => $request->email,
            'buget' => $request->buget,
            'tip_plata' => $request->tip_plata,
            'numar_camere_cautate' => $request->numar_camere_cautate,
            'oras' => $request->oras,
            'cartier' => $request->cartier,
            'zona' => $request->zona,
            'observatii' => $request->observatii
        ]);
        return redirect()->back()->with('successAdd',1);
    }
    public function search(Request $request){
        $link = array();
        if($request->nume != "") array_push($link, 'nume=' . $request->nume);
        if($request->telefon != "") array_push($link, 'telefon=' . $request->telefon);
        if($request->camere != "") array_push($link, 'camere=' . $request->camere);
        if($request->buget_minim != "") array_push($link, 'buget_minim=' . $request->buget_minim);
        if($request->buget_maxim != "") array_push($link, 'buget_maxim=' . $request->buget_maxim);
        if($request->cartier != "") array_push($link, 'cartier=' . $request->cartier);
        $link_final = '';
        foreach($link as $linkitem){
            if($link_final != '')
                $link_final = $link_final . '&' . $linkitem;
            else
                $link_final = '?' . $linkitem;
        }
        return redirect('clienti' . $link_final);
    }
    public function deleteCustomer($id) {
        if(Auth::guest())
            return redirect('/');
        DB::table('customers')->where('id','=',$id)->delete();
        return redirect()->back()->with('successDelete',1);
    }
}

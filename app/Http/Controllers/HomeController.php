<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cash;
use App\Loan;
use App\Commission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cash = Cash::latest()->first();
        
        $interest_year = Loan::whereYear('date_authorized',date('Y'))->sum('interest');
        $interest_month = Loan::whereYear('date_authorized',date('Y'))->whereMonth('date_authorized',date('m'))->sum('interest');
                
        $loans_year = Loan::whereYear('date_authorized',date('Y'))->count();
        $loans_month = Loan::whereYear('date_authorized',date('Y'))->whereMonth('date_authorized',date('m'))->count();

        $com = Commission::where('is_paid','<>','YES')->sum('commission');

        $loans = Loan::whereDate('due_date','>',date('Y-m-d'))
                        ->where('balance','>',0)
                        ->limit(20)
                        ->orderBy('due_date')
                        ->get();

        $defaulters_year = Loan::whereDate('due_date','<',date('Y-m-d'))
                        ->whereYear('due_date',date('Y'))
                        ->where('balance','>',0)
                        ->count();
        
        $defaulters_month = Loan::whereDate('due_date','<',date('Y-m-d'))
                        ->whereYear('due_date',date('Y'))
                        ->whereMonth('due_date',date('m'))
                        ->where('balance','>',0)
                        ->count();

        $stat = [
                    'cash'=>$cash->balance,
                    'interest_month'=>$interest_month,
                    'interest_year'=>$interest_year,
                    'loans_month'=>$loans_month,
                    'loans_year'=>$loans_year,
                    'commission'=>$com,
                    'defaulters_year'=>$defaulters_year,
                    'defaulters_month'=>$defaulters_month,
                ];
        return view('home')->with(['stat'=>$stat,'loans'=>$loans]);

    }
}

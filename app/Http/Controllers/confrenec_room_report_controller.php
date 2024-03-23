<?php

namespace App\Http\Controllers;
use App\Models\bookedconfrenceroom;
use PDF;
use Illuminate\Http\Request;

class confrenec_room_report_controller extends Controller
{
    public function booked_room_report(){
        return view('Admin/Generate Reports/Confrence Room Report/booked_room_report');
    }
    public function conference_room_report(){
        return view('Admin/Generate Reports/Confrence Room Report/conference_room_report');
    }

    public function confrenceRoomReport(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $bookings = bookedconfrenceroom::whereBetween('start_date', [$startDate, $endDate])
        ->orWhereBetween('end_date', [$startDate, $endDate])
        ->where('status',1)
        ->get();
     
        $data = [
            'title' => 'Conference Room Booking Report',
            'bookings' => $bookings,
        ];
      
        $pdf = PDF::loadView('Admin/Generate Reports/Confrence Room Report/conference_room_report', $data);
        
        return $pdf->stream('conference_room_report.pdf');
        
        
    }
}

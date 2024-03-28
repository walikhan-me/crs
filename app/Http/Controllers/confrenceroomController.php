<?php

namespace App\Http\Controllers;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\confrenceroom;
use App\Models\bookedconfrenceroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Notifications\BookingCreatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http; 



class confrenceroomController extends Controller
{
   public function addconfrenceroom(){
    return view('Admin/ConfrenceRoom Managment/Confrence Room/addconfrenceroom');
   }
   public function create_confrenceroom(Request $request){
    $validate = $request->validate([
        'confrenceroom' => [
            'required',
            'string',
            'max:255',
            Rule::unique('confrencerooms', 'confrence_room')->where(function ($query) use ($request) {
                return $query->whereRaw('LOWER(REPLACE(confrence_room, " ", "")) = ?', [strtolower(str_replace(' ', '', $request->confrenceroom))]);
            }),
        ],
    ], [
        'confrenceroom.unique' => 'The confrence room already exists. Please check the confrence room.',
        'confrenceroom.required' => 'The confrence room field is required.',
    ]);
    $confrenceroom = new confrenceroom();
    $confrenceroom->confrence_room = $request->confrenceroom;
    $confrenceroom->status = 1;
    $confrenceroom->save();
    return redirect()->back()->with('success', 'Confrence Room added successfully');
   }

   public function viewconfrenceroom(){
    $confrenceroom = confrenceroom::where('status',1)->get();
    return view('Admin/ConfrenceRoom Managment/Confrence Room/viewconfrenceroom',['confrenceroom_view'=> $confrenceroom]);
   }
   public function editconfrenceroom($id){
    $confrenceroom = confrenceroom::find($id);
    return view('Admin/ConfrenceRoom Managment.Confrence Room.editconfrenceroom', ['edit_confrenceroom' => $confrenceroom]);

   }
   public function editinconfrenceroom(Request $request){
        $validatedData = $request->validate([
            'edit_confrence_room_name' => 'required|string|max:255',
            'edit_confrence_room_id' => 'required|integer',
        ]);
        
        
        $confrence_room_name = confrenceroom::find($request->edit_confrence_room_id);

        if (!$confrence_room_name) {
            return redirect()->back()->with('error', 'Confrence Room not found');
        }
        $confrence_room_name->confrence_room = $request->edit_confrence_room_name;
    
        $confrence_room_name->status = 1;
        $confrence_room_name->save();
        return redirect()->route('viewconfrenceroom')->with('success', 'Confrence Room updated successfully');

   }
   public function  deleteconfrenceroom($id){
    $confrenceroom = confrenceroom::find($id);
        if (!$confrenceroom) {
            return redirect()->route('viewconfrenceroom')->with('error', 'Department not found');
        }
        $confrenceroom->status = 0;
        $confrenceroom->save();
        return redirect()->route('viewconfrenceroom')->with('success', 'Confrence Room set as inactive successfully');
   }
   public function bookedconfreneceroom() {
        $conferenceRooms = confrenceroom::all();
        return view('Admin/ConfrenceRoom Managment/Booked Confrence Room/bookedconfreneceroom', compact('conferenceRooms'));
    }
   public function searchEmployees(Request $request)
   {
       $query = $request->input('query');

       $employees = Employee::where('employee_name', 'like', '%' . $query . '%')
           ->orWhere('email', 'like', '%' . $query . '%')
           ->orWhere('user_name', 'like', '%' . $query . '%')
           ->orWhere('mobile', 'like', '%' . $query . '%')
           ->get();

       return response()->json(['employees' => $employees]);
   }



// public function create_bookedconfrenceroom(Request $request)
// {
    
//    $validate =  $request->validate([
//         'username' => 'required|string',
//         'user_id' => 'required|string',
//         'user_email' => 'required|email',
//         'conference_room' => 'required',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date|after:start_date',
//         'start_time' => 'required',
//         'end_time' => 'required|after:start_time',
//         'selected_employee_ids' => 'required|array|min:1',
//         'selected_employee_names' => 'required|array|min:1',
//     ]);
   
//     $bookedConfrenceRoom = new bookedconfrenceroom();
//     $participantEmails = $request->input('selected_employee_emails');
//     $participantNames = $request->input('selected_employee_names');
//     // Assign form data to the model attributes
//     $bookedConfrenceRoom->username = $request->input('username');
//     $bookedConfrenceRoom->user_id = $request->input('user_id');
//     $bookedConfrenceRoom->user_email = $request->input('user_email');
//     $bookedConfrenceRoom->conference_room = $request->input('conference_room');
//     $bookedConfrenceRoom->start_date = $request->input('start_date');
//     $bookedConfrenceRoom->end_date = $request->input('end_date');
//     $bookedConfrenceRoom->start_time = $request->input('start_time');
//     $bookedConfrenceRoom->end_time = $request->input('end_time');
//     $bookedConfrenceRoom->participant_emails = json_encode($participantEmails); // Convert to JSON
//     $bookedConfrenceRoom->participant_names = json_encode($participantNames);
    
//     $bookedConfrenceRoom->status = 'pending';
//     $bookedConfrenceRoom->save();
   
//     $selectedEmployeeIds = $request->input('selected_employee_ids');

//     $validEmails = [];
//     foreach ($selectedEmployeeIds as $email) {
//         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $validEmails[] = $email;
//         } else {
//             Log::error("Invalid email address: $email");
//         }
//     }


//     if (empty($validEmails)) {
//         dd("No valid email addresses found.");
//     }
   
//     $participantEmailsContent = implode(', ', $validEmails);
//     $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', config('services.sendinblue.key'));
  

//     $requestHeaders = [
//         'Content-Type' => 'application/json',
//         'api-key' => config('services.sendinblue.key'),
//     ];

//     // Log request headers for debugging
//     Log::info('Request Headers: ' . json_encode($requestHeaders));

//     $apiInstance = new TransactionalEmailsApi(null, $config);

//     $sendSmtpEmail = new SendSmtpEmail([
//         'to' => array_map(fn($email) => ['email' => $email], $validEmails),
//         'subject' => 'Scheduled Conference Room Meeting',
//         'htmlContent' => '
//             <p>Dear '. implode(', ', $participantNames) .' </p>
            
//             <p>We are pleased to inform you that a conference room meeting has been scheduled:</p>

//             <p><strong>Conference Room:</strong> ' . $request->input('conference_room') . '</p>
//             <p><strong>Meeting Time:</strong> ' . $request->input('start_time') . ' to ' . $request->input('end_time') . '</p>
//             <p><strong>Meeting Date:</strong> ' . $request->input('start_date') . ' to ' . $request->input('end_date') . '</p>

//             <p>Please make a note of the details, and ensure your availability for the scheduled meeting.</p>

//             <p>Thank you for your cooperation. If you have any questions or concerns, feel free to contact us.</p>

//             <p>Best regards,<br>
//             EOBI Soft</p>
//         ',
//         'sender' => ['email' => $request->input('user_email'), 'name' => $request->input('username')],
//     ]);
  
//     try {
    
//         $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        
//         if ($result) {
//             $bookedConfrenceRoom->save();
//             return redirect()->back()->with('success', 'Email sent successfully!');
//         } else {
//             return redirect()->back()->with('error', 'Failed to send email. Please try again.');
//         }
       
//     } catch (Exception $e) {
      
//         dd($e->getMessage());
//     }
// }


public function create_bookedconfrenceroom(Request $request)
{
    $validate = $request->validate([
        'username' => 'required|string',
        'user_id' => 'required|string',
        'user_email' => 'required|email',
        'conference_room' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'selected_employee_ids' => 'required|array|min:1',
        'selected_employee_names' => 'required|array|min:1',
    ]);
   
    $bookedConfrenceRoom = new bookedconfrenceroom();
    $participantEmails = $request->input('selected_employee_emails');
    $participantNames = $request->input('selected_employee_names');
    // Assign form data to the model attributes
    $bookedConfrenceRoom->username = $request->input('username');
    $bookedConfrenceRoom->user_id = $request->input('user_id');
    $bookedConfrenceRoom->user_email = $request->input('user_email');
    $bookedConfrenceRoom->conference_room = $request->input('conference_room');
    $bookedConfrenceRoom->start_date = $request->input('start_date');
    $bookedConfrenceRoom->end_date = $request->input('end_date');
    $bookedConfrenceRoom->start_time = $request->input('start_time');
    $bookedConfrenceRoom->end_time = $request->input('end_time');
    $bookedConfrenceRoom->participant_emails = json_encode($participantEmails); // Convert to JSON
    $bookedConfrenceRoom->participant_names = json_encode($participantNames);
    
    $bookedConfrenceRoom->status = 'pending';
    $bookedConfrenceRoom->save();
   
    $selectedEmployeeIds = $request->input('selected_employee_ids');

    $validEmails = [];
    foreach ($selectedEmployeeIds as $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validEmails[] = $email;
        } else {
            Log::error("Invalid email address: $email");
        }
    }

    if (empty($validEmails)) {
        
        return redirect()->back()->with('error', 'No valid email addresses found.');
    }
   
    $participantEmailsContent = implode(', ', $validEmails);

    // Make HTTP POST request to the Brevo API endpoint
    $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => config('services.sendinblue.key'),
            'content-type' => 'application/json'
        ])
        ->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => $request->input('username'),
                'email' => $request->input('user_email')
            ],
            'to' => array_map(fn($email) => ['email' => $email], $validEmails),
            'subject' => 'Scheduled Conference Room Meeting',
            'htmlContent' => '<p>Dear '. implode(', ', $participantNames) .' </p><p>We are pleased to inform you that a conference room meeting has been scheduled:</p><p><strong>Conference Room:</strong> ' . $request->input('conference_room') . '</p><p><strong>Meeting Time:</strong> ' . $request->input('start_time') . ' to ' . $request->input('end_time') . '</p><p><strong>Meeting Date:</strong> ' . $request->input('start_date') . ' to ' . $request->input('end_date') . '</p><p>Please make a note of the details, and ensure your availability for the scheduled meeting.</p><p>Thank you for your cooperation. If you have any questions or concerns, feel free to contact us.</p><p>Best regards,<br>EOBI Soft</p>'
        ]);
    
    if ($response->successful()) {
        $bookedConfrenceRoom->save();
        return redirect()->back()->with('success', 'Email sent successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to send email. Please try again.');
    }
}


public function viewbookedconfrenceroom(){
    $bookedconfrenceroom = DB::table('bookedconfrencerooms')->where('status',1)->get();
  
    return view('Admin/ConfrenceRoom Managment/Booked Confrence Room/viewbookedconfrenceroom',['bookedconfrenceroom'=> $bookedconfrenceroom]);
}

   public function editbookedconfrenceroom($id){
    $editbbookedconfrenceroom = bookedconfrenceroom::find($id);
    $allConferenceRooms = confrenceroom::all();
    return view('/ConfrenceRoom Managment.Booked Confrence Room.editbookedconfrenceroom', [
        'editbookedconfrenceroom' => $editbbookedconfrenceroom,
        'allConferenceRooms' => $allConferenceRooms,
    ]);
    // return view('/ConfrenceRoom Managment.Booked Confrence Room.editbookedconfrenceroom', ['editbookedconfrenceroom' => $editbbookedconfrenceroom]);
   }

   public function cancelmeeting($id)
    {
        
        $bookedconfrenceroom = bookedconfrenceroom::find($id);
        if (!$bookedconfrenceroom) {
            return redirect()->route('viewbookedconfrenceroom')->with('error', 'Confrence Meeting  not found');
        }
        $bookedconfrenceroom->status = 0;
        $bookedconfrenceroom->save();
        return redirect()->route('viewbookedconfrenceroom')->with('success', 'Confrence Room Meeting cancel  successfully');
    }
}

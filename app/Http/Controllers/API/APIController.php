<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;

class APIController extends Controller
{
    public function sendInvitation(Request $request){

        $data = new Invitation;

        $data->sender_email = $request->sender_email;
        $data->receiver_email = $request->receiver_email;
        $data->occation = $request->occation;
        $data->details = $request->details;
        $result = $data->save();

        if($result){
            // return response()->json($data);
            return view('invitationCompose');
        }
        else{
            return "operation failed";
        }

    }

    public function showInvitations($email){

       $invitations = Invitation::where('receiver_email', $email)->where('status','accepted')->get();

        // return response()->json($invitations);
       return view('acceptedInvitations')->with('invitations' , $invitations);
    }

    public function requestedInvitation($email){
        $infos = Invitation::where('receiver_email', $email)->where('status','pending')->get();

        // return response()->json($infos);
        return view('invitations')->with('infos' , $infos);

    }

    public function destroy($id){
        
       $result =Invitation::find($id);
       $result->delete();

       $infos = Invitation::where('status','pending')->get();

        if( $result){
            // return response()->json($infos);
            return view('Invitations')->with('infos' , $infos);
        }
        else{
            return "something went wrong";
        }
        
    }

    public function acceptInvitation($id){
        $result = Invitation::find($id);
        $result->status = 'accepted';
        $result->save();

        $infos = Invitation::all()->where('status','pending');
 
         if( $result){
            // return response()->json($infos);
             return view('Invitations')->with('infos' , $infos);
         }
         else{
             return "something went wrong";
         }
         
    }

    public function goToInvitationCompose(){
        
        return view('invitationCompose');
    }
}
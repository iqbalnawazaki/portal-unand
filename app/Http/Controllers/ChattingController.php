<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Periode;
use App\Topik;
use App\Events\NewMessage;
use App\Events\MessageGrup;

class ChattingController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function chatting(Request $request)
  {
       if ($request->user()->hasRole('dosen')) {
           return view('dosen.chatting.chatting');
       }
       elseif ($request->user()->hasRole('mahasiswa')){
           
            return view('mahasiswa.chatting.chatting');           
       }
  }

  public function grup(Request $request)
  {
      if ($request->user()->hasRole('dosen')) {
           return view('dosen.chatting.grupchat');
       }
       elseif ($request->user()->hasRole('mahasiswa')){
            return view('mahasiswa.chatting.grupchat');          
       }
  }

  public function fetchMessages(Request $request)
   {
        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa_pa/'.$user->id, false, $context);
        $mhs = json_decode($strMhs);

        if ($request->user()->hasRole('dosen')) {
            $dosenGrup = Message::where(['penerima_id'=> $user->id])
            ->where('topik_id',8)
             ->with('user')
             ->get(); 
            return $dosenGrup;
            
        }
        else {
            $dosenpa = User::where('id',$mhs->dosenpa)->select('id')->first();
            $mahasiswaGrup = Message::where(['penerima_id'=> $dosenpa->id])
            ->where('topik_id',8)
            ->with('user')
            ->get();
             return $mahasiswaGrup;
        }      
   }

   public function sendMessage(Request $request)
   {
        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
        $max = json_decode($link);
        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa_pa/'.$user->id, false, $context);
        $mhs = json_decode($strMhs);
        $topik_grup = 8;

        if ($request->user()->hasRole('dosen')) {
              if($request->get('image'))
                {
                    $image = $request->get('image');
                    $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                    \Image::make($request->get('image'))->save(public_path('images/').$name);

                    $message=Message::create([
                        'user_id' => request()->user()->id,
                        'penerima_id' => $user->id,
                        'image' => $image = $name,
                        'semester_id'=>$max->semester_id,
                        'topik_id'=>$topik_grup
                    ]);

                }
              else{
                        $message=auth()->user()->messages()->create([
                            'pesan'=>$request->message,
                            'penerima_id' => $user->id,
                            'semester_id'=>$max->semester_id,
                            'topik_id'=>$topik_grup
                            ]);
             }

            
        }
        else{
        $dosenpa = User::where('id',$mhs->dosenpa)->select('id')->first();
        if($request->get('image'))
           {
               $image = $request->get('image');
               $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
               \Image::make($request->get('image'))->save(public_path('images/').$name);

               $message=Message::create([
                   'user_id' => request()->user()->id,
                   'penerima_id' => $dosenpa->id,
                   'image' => $image = $name,
                   'semester_id'=>$max->semester_id,
                   'topik_id'=>$topik_grup
               ]);

           }
       else{
               $message=auth()->user()->messages()->create([
                   'pesan'=>$request->message,
                   'penerima_id' => $dosenpa->id,
                   'semester_id'=>$max->semester_id,
                   'topik_id'=>$topik_grup
                ]);
       }
       }
       broadcast(new MessageGrup(auth()->user(),$message->load('user')))->toOthers();

       return response(['status'=>'Message sent successfully','message'=>$message]);
   }

   public function get(Request $request)
   {    
     if ($request->user()->hasRole('dosen')) {
        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $strMhs = file_get_contents('http://localhost:8000/api/dosenpa/'.$user->id, false, $context);
        $mhs = json_decode($strMhs);

        foreach ($mhs as $key => $value) {
            if ($value->dosenpa == $user->id) {
               
            $contax = User::where('id', '!=', auth()->id())
                    ->where('id', $value->pa_nim)
                    ->select(
                        'id as id',
                        'name as name',
                        'email as email',
                        'avatar as avatar'
                    )->first();
                    
                if($contax) $contacts [] = $contax; 
                }
        }    
       $unreadIds = Message::select(\DB::raw('`user_id` as sender_id, count(`user_id`) as messages_count'))
           ->where('penerima_id', auth()->id())
           ->where('read', false)
           ->groupBy('user_id')
           ->get();

       $collection = collect($contacts);
       $collection->map(function($contact) use ($unreadIds) {
           $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

           $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            
           return $contact;
       });
    }

    elseif ($request->user()->hasRole('mahasiswa')) {
     $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa_pa/'.$user->id, false, $context);
        $mhs = json_decode($strMhs);

        $contax = User::where('id', '!=', auth()->id())
        ->where('id', $mhs->dosenpa)
        ->select(
            'id as id',
            'name as name',
            'email as email',
            'avatar as avatar'
        )->first();

        $contacts[] = $contax;
             
       
       $unreadIds = Message::select(\DB::raw('`user_id` as sender_id, count(`user_id`) as messages_count'))
           ->where('penerima_id', auth()->id())
           ->where('read', false)
           ->groupBy('user_id')
           ->get();

       $collection = collect($contacts);
       $collection->map(function($contact) use ($unreadIds) {
           $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

           $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            
           return $contact;
       });

    }
   

       return response()->json($contacts);
   }

//     public function getDosen()
//     {    
//         $user = Auth::user();
//         $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
//         $context = stream_context_create($opts);
//         $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa_pa/'.$user->nim, false, $context);
//         $mhs = json_decode($strMhs);

//         $contax = User::where('id', '!=', auth()->id())
//         ->where('nim', $mhs->dosenpa)
//         ->select(
//             'id as id',
//             'name as name',
//             'email as email',
//             'nim as nim',
//             'avatar as avatar'
//         )->first();
//         $contacts[] = $contax;
//        $unreadIds = Message::select(\DB::raw('`user_id` as sender_id, count(`user_id`) as messages_count'))
//            ->where('penerima_id', auth()->id())
//            ->where('read', false)
//            ->groupBy('user_id')
//            ->get();
//        $collection = collect($contacts);
//        $collection->map(function($contact) use ($unreadIds) {
//            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
//            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;          
//            return $contact;
//        });
//        return response()->json($contacts);
//    }


   public function getMessagesFor($id)
   {
       Message::where('user_id', $id)->where('penerima_id', auth()->id())->update(['read' => true]);

       $messages = Message::leftJoin('topiks','messages.topik_id','=','topiks.id')
       ->where(function($q) use ($id) {
           $q->where('user_id', auth()->id());
           $q->where('penerima_id', $id)
           ->whereNotIn('topik_id',[8]);
       })->orWhere(function($q) use ($id) {
           $q->where('user_id', $id);
           $q->where('penerima_id', auth()->id())
           ->whereNotIn('topik_id',[8]);
       })
       ->select(
           'messages.id as id',
           'user_id',
           'penerima_id',
           'pesan',
           'image',
           'read',
           'messages.semester_id as semester_id',
           'topiks.topik as topik',
           'messages.created_at as created_at'
       )->get();

       return response()->json($messages);
   }

   public function send(Request $request)
   {
       
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
        $max = json_decode($link);

        $periode = Periode::where('status',1)->select('id')->first();
        //simpan pesan private chat dari mahasiswa
        if($request->user()->hasRole('mahasiswa')){
        if($request->get('image'))
           {
               $image = $request->get('image');
               $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
               \Image::make($request->get('image'))->save(public_path('images/').$name);

               $message=Message::create([
                   'user_id' => request()->user()->id,
                   'penerima_id' => $request->contact_id,
                   'image' => $image = $name,
                   'semester_id'=>$max->semester_id,
                   'topik_id'=>$request->topik
                ]);
           }
       else{
           $message = Message::create([
           'user_id' => auth()->id(),
           'penerima_id' => $request->contact_id,
           'pesan' => $request->pesan,
           'semester_id'=>$max->semester_id,
           'topik_id'=>$request->topik
           ]);
       }
       broadcast(new NewMessage($message));

       return response()->json($message);
    }//end mahasiswa
       //simpan pesan private chat dari dosen
       elseif ($request->user()->hasRole('dosen')){
         $topikMahasiswa = Message::where('user_id',$request->contact_id)
         ->where('penerima_id',  auth()->id())
         ->whereNotIn('topik_id',[8])
         ->orderBy('id', 'desc')
         ->select('topik_id')
         ->first();

        if($request->get('image'))
           {
               $image = $request->get('image');
               $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
               \Image::make($request->get('image'))->save(public_path('images/').$name);

               $message=Message::create([
                   'user_id' => request()->user()->id,
                   'penerima_id' => $request->contact_id,
                   'image' => $image = $name,
                   'semester_id'=>$max->semester_id,
                   'topik_id'=>$topikMahasiswa->topik_id
                ]);
           }
       else{
           $message = Message::create([
           'user_id' => auth()->id(),
           'penerima_id' => $request->contact_id,
           'pesan' => $request->pesan,
           'semester_id'=>$max->semester_id,
           'topik_id'=>$topikMahasiswa->topik_id
           ]);
       }
    
       broadcast(new NewMessage($message));

       return response()->json($message);
    }
       //end dosen

   }

   function topikChatting()
   {
    $topik = Topik::join('periodes','topiks.periode_id','=','periodes.id')
    ->whereNotIn('topiks.id',[8])
    ->where('periodes.status',1)
    ->select(
        'topiks.id as id',
        'topiks.topik as topik',
        'topiks.periode_id as periode'
    )
    ->get();
    return response()->json($topik);
           
   }
   
}

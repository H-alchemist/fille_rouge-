<?php 


namespace App\Services;
use App\Models\Move;
use App\Models\Partie;
use App\Models\Message;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


class SavePatrieServices{
    
    

    public function saveData($allData){


         Log::info("rr" , $allData);
         
        


        $dataP['white_player'] = $allData['state']['whitePlayerData']['accounId'];
        $dataP['black_player'] = $allData['state']['blackPlayerData']['accounId'];
        $dataP['partie_status'] = $allData['gameState']['state'];
        
        // Log::info('first' , $dataP);
       

        if ($allData['gameState']['winner'] == 'white') {
            $dataP['winner'] = $dataP['white_player'];
            $dataP['loser'] = $dataP['black_player'];
        } elseif ($allData['gameState']['winner'] == 'black') {
            $dataP['winner'] = $dataP['black_player'];
            $dataP['loser'] = $dataP['white_player'];
        } else {
            $dataP['winner'] = null;
            $dataP['loser'] = null;
        }
        
        $dataP['time_control'] = $allData['state']['timeControl'];

        $partie = Partie::create($dataP);
        

        ///////////////// moves 

//         $dataM = [];
// $moveNumber = 1;

// foreach ($allData['state']['gameMoves'] as $move) {
//     $dataM[] = [
//         'partie_id' => $partie->id, // You will get it after inserting the Partie
//         'from_position' => implode(',', $move['from']), // example "6,7"
//         'to_position' => implode(',', $move['to']),     // example "5,7"
//         'piece_number' => $move['piece'], 
//         'moveNumber' => $moveNumber++,
//         'timestamp' => now(),
//     ];
// }

//   Move::insert($dataM);


if (!empty($allData['state']['gameMoves'])) {
    $dataM = [];
    $moveNumber = 1;

    foreach ($allData['state']['gameMoves'] as $move) {
        $dataM[] = [
            'partie_id' => $partie->id, // You got it after inserting Partie
            'from_position' => implode(',', $move['from']), // example: "6,7"
            'to_position' => implode(',', $move['to']),     // example: "5,7"
            'piece_number' => $move['piece'], 
            'moveNumber' => $moveNumber++,
            'timestamp' => now(),
        ];
    }

    Move::insert($dataM);
}




$dataC = [];

if (!empty($allData['chat'])) {
    $dataC = [];

    foreach ($allData['chat'] as $index => $chat) {
        
        $dataC[] = [
            'partie_id' => $partie->id, // you already inserted Partie and got $partieId
            'sender_name' => $chat['sender'],
            'messege_number' => $index + 1,
            'content' => $chat['message'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }


    Log::info("dataC" , $dataC);

    Message::insert($dataC);
}









        
}






    
}
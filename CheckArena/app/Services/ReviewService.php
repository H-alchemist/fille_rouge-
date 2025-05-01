<?php
namespace App\Services;
use App\Models\Move;
use App\Models\Partie;
use App\Models\Message;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


class ReviewService {


    public function getPartieData($partieId)
    {
        $query = 
        " SELECT 
                        p.id,
                        p.*,
                        wu.username AS white_username,
                        bu.username AS black_username,
                        wpr.avatar AS white_avatar,
                        bpr.avatar AS black_avatar,
                        wpr.elo AS white_elo,
                        bpr.elo AS black_elo,
                        COALESCE(json_agg( m) FILTER (WHERE m.id IS NOT NULL), '[]') AS moves,
                        COALESCE(json_agg( ms) FILTER (WHERE ms.id IS NOT NULL), '[]') AS messages

                      FROM parties p
                      JOIN users wu ON wu.id = p.white_player
                      JOIN users bu ON bu.id = p.black_player
                      JOIN profiles wpr ON wpr.user_id = wu.id
                      JOIN profiles bpr ON bpr.user_id = bu.id
                      LEFT JOIN moves m ON m.partie_id = p.id
                      LEFT JOIN messages ms ON ms.partie_id = p.id
                      WHERE p.id = :partieId
                      GROUP BY p.id, wu.username, bu.username, wpr.avatar, bpr.avatar, wpr.elo, bpr.elo;
"
        ;

        $partieData = DB::select($query, ['partieId' => $partieId]);

        return $partieData[0];


    }

}
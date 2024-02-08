<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArgRequest;
use App\Http\Requests\UnbanRequest;
use App\Models\Ban;
use App\Models\Server;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use xPaw\SourceQuery\SourceQuery;

class BansController extends Controller
{
    public function get()
    {
        $bans = Ban::all();

        return json_encode($bans);
    }

    public function getByName(string $name)
    {
        $bans = Ban::all();
        $filtered = [];
        foreach ($bans as $ban) {
            if (str_contains($ban['name'], $name)) {
                $filtered[] = $ban;
            }
        }
        return json_encode($filtered);
    }
    public function getBySid(string $sid)
    {
        $bans = Ban::query()->where('sid', $sid)->get();
        return json_encode($bans);
    }
    public function getByTime(string $time)
    {
        $bans = Ban::query()->where('time', $time)->get();
        return json_encode($bans);
    }
    public function getByIp(string $ip)
    {
        $bans = Ban::all();
        $filtered = [];
        foreach ($bans as $ban) {
            if (str_contains($ban['ip'], $ip)) {
                $filtered[] = $ban;
            }
        }
        return json_encode($filtered);
    }

    public function unban(UnbanRequest $request)
    {
        $user = Auth::user();

        if (!str_contains($user['web_flags'], 'u') && !str_contains($user['web_flags'], 'z'))
            return 'false';

        $servers = Server::all();

        foreach ($servers as $server) {
            if (!str_contains($server['server_id'], $request['server_id']))
                continue;
            $Query = new SourceQuery();

            try {
                $Query->Connect($server['ip'], $server['port'], 1, SourceQuery::SOURCE);

                $Query->SetRconPassword($server['rcon']);

                $Query->Rcon("css_runban {$request['arg']} {$user['steam_id']}");
                return 'true';
            } catch (Exception $e) {
                return $e;
            }
        }
        return 'true';
    }
}
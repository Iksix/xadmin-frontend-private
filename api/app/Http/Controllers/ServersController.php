<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArgRequest;
use App\Http\Requests\ServerAddRequest;
use App\Models\Ban;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use xPaw\SourceQuery\SourceQuery;

class ServersController extends Controller
{
    public function get()
    {
        $user = Auth::user();

        if (!str_contains($user['web_flags'], 'z')) return 'null';
        $servers = Server::all();

        return json_encode($servers);
    }

    public function add(ServerAddRequest $request)
    {
        $user = Auth::user();

        if (!str_contains($user['web_flags'], 'z')) return 'false';

        Server::create(array(
            'name' => $request['name'],
            'ip' => $request['ip'],
            'port' => $request['port'],
            'rcon' => $request['rcon'],
            'server_id' => $request['server_id'],
        ));

        return 'true';
    }
    public function delete(ArgRequest $request)
    {
        $user = Auth::user();

        if (!str_contains($user['web_flags'], 'z')) return 'false';

        Server::query()->where('id', $request['arg'])->delete();

        return 'true';
    }

    public function getPlayers($id)
    {
        $user = Auth::user();

        if (!str_contains($user['web_flags'], 'u') && !str_contains($user['web_flags'], 'z'))
            return 'false';

        $servers = Server::all();


        foreach ($servers as $server) {
            if (!str_contains($server['server_id'], $id))
            continue;
            $Query = new SourceQuery();

            try {
                $Query->Connect($server['ip'], $server['port'], 1, SourceQuery::SOURCE);

                $Query->SetRconPassword($server['rcon']);

                $result = $Query->Rcon("xapi_getplayers");

                return $result;
            } catch (Exception $e) {
                return $e;
            }
        }
        return 'true';
    }

}

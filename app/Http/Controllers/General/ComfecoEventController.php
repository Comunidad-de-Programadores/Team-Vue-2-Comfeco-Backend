<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;
use App\Repositories\General\ComfecoEventRepository;

class ComfecoEventController extends CustomController
{
    protected $comfecoEventRepository;

    public function __construct(ComfecoEventRepository $comfecoEventRepository)
    {
        parent::__construct();
        $this->comfecoEventRepository = $comfecoEventRepository;
    }

    public function list()
    {
        $records = $this->comfecoEventRepository->list();
        return response()->json(['records' => $records], $this->successStatus);
    }

    public function listByUser()
    {
        $records = $this->comfecoEventRepository->listByUser(request()->user()->id);
        return response()->json(['records' => $records], $this->successStatus);
    }

    public function detail($id)
    {
        $detail = $this->comfecoEventRepository->findById($id);
        return response()->json(['data' => $detail], $this->successStatus);
    }

    public function attachToUser($comfecoEventId)
    {
        $user = request()->user();
        if ($this->comfecoEventRepository->checkIsAttach($user, $comfecoEventId)) {
            $response = [
                "error" => true,
                "message" => "El usuario ya está asignado a este evento"
            ];
            return response()->json($response, $this->errorStatus);
        }

        try {
            $this->comfecoEventRepository->attachEventToUser($user, $comfecoEventId);
            $response = [
                "error" => false,
                "message" => "Evento asignado correctamente"
            ];
            return response()->json($response, $this->successStatus);
        } catch (\Throwable $th) {
            $response = [
                "error" => true,
                "message" => $th->getMessage()
            ];
            return response()->json($response, $this->errorStatus);
        }
    }

    public function detachToUser($comfecoEventId)
    {
        $user = request()->user();
        if (!$this->comfecoEventRepository->checkIsAttach($user, $comfecoEventId)) {
            $response = [
                "error" => true,
                "message" => "El usuario ya no tiene asignado este evento"
            ];
            return response()->json($response, $this->errorStatus);
        }

        try {
            $this->comfecoEventRepository->detachEventToUser($user, $comfecoEventId);
            $response = [
                "error" => false,
                "message" => "Evento desasignado correctamente"
            ];
            return response()->json($response, $this->successStatus);
        } catch (\Throwable $th) {
            $response = [
                "error" => true,
                "message" => $th->getMessage()
            ];
            return response()->json($response, $this->errorStatus);
        }
    }
}

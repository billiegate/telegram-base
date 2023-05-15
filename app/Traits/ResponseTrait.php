<?php
namespace App\Traits;


/**
 * http response for request
 */
trait ResponseTrait
{
    
    public function JsonResponse($data, $messages = 'Request sucessful', $status = 200)
    {  
        return response()->json([
            'status'=> $status,
            'message'=> $messages,
            'data' => $data
        ], $status);
    }

    public function successResponse($data, $messages = 'Request sucessful', $status = 200)
    {
        return $this->JsonResponse($data, $messages, $status);
    }

    public function errorResponse($data, $messages = 'An error occured', $status = 400)
    {
        return $this->JsonResponse($data, $messages, $status);
    }

}
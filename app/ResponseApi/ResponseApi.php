<?php

namespace App\ResponseApi;

trait ResponseApi
{
  /**
   * Success response
   */
  protected function success($data = null, $message = 'Success', $status = 200)
  {
    return response()->json([
      'status' => true,
      'code' => $status,
      'message' => $message,
      'data' => $data
    ], $status);
  }

  /**
   * Error response
   */
  protected function error($message = 'Something went wrong', $status = 400, $data = null)
  {
    return response()->json([
      'status' => false,
      'code' => $status,
      'message' => $message,
      'data' => $data
    ], $status);
  }
}

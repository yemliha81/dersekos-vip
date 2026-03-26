<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function generateSignature(Request $request)
    {
        $sdkKey = config('services.zoom.sdk_key');
        $sdkSecret = config('services.zoom.sdk_secret');

        $meetingNumber = $request->meetingNumber;
        $role = $request->role ?? 0;

        $iat = time() - 30;
        $exp = $iat + 60 * 60 * 2;

        $payload = [
            "sdkKey" => $sdkKey,
            "mn" => $meetingNumber,
            "role" => $role,
            "iat" => $iat,
            "exp" => $exp,
            "appKey" => $sdkKey,
            "tokenExp" => $exp
        ];

        $base64UrlEncode = function ($data) {
            return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
        };

        $header = ["alg" => "HS256", "typ" => "JWT"];

        $base64UrlHeader = $base64UrlEncode($header);
        $base64UrlPayload = $base64UrlEncode($payload);

        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $sdkSecret, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return response()->json([
            "signature" => "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature"
        ]);
    }
}
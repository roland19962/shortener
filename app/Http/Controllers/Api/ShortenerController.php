<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ShortenerSaveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\UrlAlias;
use Illuminate\Support\Facades\Http;

class ShortenerController extends Controller
{
    public function generateHash($currentUrl) {
        $hash = Hash::make($currentUrl);
        $hash = str_replace(['.', '/'], '', $hash);
        $hash = substr($hash, -32, 6);
        return $hash;
    }

    public function getNewHash($currentUrl) {

        $hash = $this->generateHash($currentUrl);
        $oldUrlAlias = UrlAlias::find($hash);

        while ($oldUrlAlias instanceof UrlAlias) {
            $hash = $this->generateHash($currentUrl);
            $oldUrlAlias = UrlAlias::find($hash);
        }

        return $hash;
    }

    public function saveUrlAlias($currentUrl) {

        DB::beginTransaction();

        $urlAlias = new UrlAlias();
        $urlAlias->hash = $this->getNewHash($currentUrl);
        $urlAlias->url = $currentUrl;
        $urlAlias->save();

        DB::commit();

        return $urlAlias;
    }

    public function checkUrl($currentUrl)
    {

        $url = env('SAFEBROWSING_URL') . '?key=' . env('SAFEBROWSING_API_KEY');

        $headers = [
            'Content-Type' => 'application/json'
        ];

        $data = [
            "threatInfo" => [
                "threatTypes" => [
                    "THREAT_TYPE_UNSPECIFIED",
                    "MALWARE",
                    "SOCIAL_ENGINEERING",
                    "UNWANTED_SOFTWARE",
                    "POTENTIALLY_HARMFUL_APPLICATION"
                ],
                "platformTypes" => ["ANY_PLATFORM"],
                "threatEntryTypes" => ["URL"],
                "threatEntries" => [
                    [
                        "url" => $currentUrl
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders($headers)->post($url, $data);
        $result = $response->json();
        if (!empty($result) && is_array($result) && count($result) > 0 && array_key_exists('matches', $result)) {
            return false;
        }

        return true;
    }

    public function saveUrlAliasAction(ShortenerSaveRequest $request)
    {
        $currentUrl = htmlspecialchars(trim($request->get('url')));

        if (!$this->checkUrl($currentUrl)) {
            return response()->json(
                [
                    "message" => "This url is threat",
                    "errors" => [
                        "url" => [
                            "This url is threat"
                        ]
                    ]
                ], 422);
        }

        $currentUrlAlias = UrlAlias::where('url', $currentUrl)->first();
        if (!$currentUrlAlias instanceof UrlAlias) {
            $currentUrlAlias = $this->saveUrlAlias($currentUrl);
        }

        return response()->json(
            [
                'urlAlias' => $currentUrlAlias
            ]);
    }
}

<?php

namespace App\Services\Notifications;

use Exception;
use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FireBase
{
    public static function send($heading, $message, $deviceIds, $data = [])
    {
        $deviceIds = array_values(array_filter($deviceIds));

        if (empty($deviceIds)) {
            Log::channel('firebase')->warning('No device IDs provided.');
            throw new Exception('No device IDs provided');
        }

        try {
            Log::channel('firebase')->info('Preparing FCM notification...', [
                'title' => $heading,
                'body' => $message,
                'device_ids' => $deviceIds,
                'data' => $data
            ]);

            $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
            $credentials = new ServiceAccountCredentials($scopes, config('services.firebase.credentials'));
            $accessToken = $credentials->fetchAuthToken()['access_token'];
            $projectId = config('services.firebase.project_id');

            $messagePayload = [
                'notification' => [
                    'title' => $heading,
                    'body' => $message,
                ],
                'android' => [
                    'priority' => 'high',
                    'notification' => ['sound' => 'default'],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => ['sound' => 'default'],
                    ],
                ],
            ];

            if (!empty($data)) {
                $messagePayload['data'] = $data;
            }

            $messagePayload += count($deviceIds) > 1
                ? ['tokens' => $deviceIds]
                : ['token' => $deviceIds[0]];

            $payload = ['message' => $messagePayload];
            $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

            Log::channel('firebase')->debug('Sending FCM request...', [
                'url' => $url,
                'payload' => $payload,
            ]);

            $client = new Client();
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            Log::channel('firebase')->info('FCM notification sent successfully.', [
                'response_status' => $response->getStatusCode(),
                'response_body' => $response->getBody()->getContents(),
            ]);

            return $response;

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $body = $e->getResponse()->getBody()->getContents();

            Log::channel('firebase')->error('FCM ClientException Error', [
                'error_message' => $e->getMessage(),
                'response_body' => $body,
                'device_ids' => $deviceIds,
            ]);

            throw new Exception($body);

        } catch (\Exception $e) {
            Log::channel('firebase')->critical('Unexpected Firebase Error', [
                'message' => $e->getMessage(),
                'device_ids' => $deviceIds,
            ]);

            throw $e;
        }
    }
}

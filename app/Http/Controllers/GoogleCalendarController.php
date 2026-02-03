<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    private function getServiceAccountClient()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/dersekos-562ec8b59cd0.json'));
        $client->addScope(Calendar::CALENDAR);

        return $client;
    }

    public function addEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end'   => 'required',
        ]);

        $client = $this->getServiceAccountClient();
        $service = new \Google\Service\Calendar($client);

        $start = \Carbon\Carbon::parse($request->start, 'Europe/Istanbul')
            ->setTimezone('Europe/Istanbul')
            ->toRfc3339String();

        $end = \Carbon\Carbon::parse($request->end, 'Europe/Istanbul')
            ->setTimezone('Europe/Istanbul')
            ->toRfc3339String();

        if ($start >= $end) {
            return back()->withErrors('Bitiş tarihi başlangıçtan sonra olmalıdır.');
        }

        $event = new \Google\Service\Calendar\Event([
            'summary' => $request->title,
            'description' => $request->description,
            'start' => [
                'dateTime' => $start,
                'timeZone' => 'Europe/Istanbul',
            ],
            'end' => [
                'dateTime' => $end,
                'timeZone' => 'Europe/Istanbul',
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => \Str::uuid(),
                ],
            ],
        ]);

        $calendarId = auth('teacher')->user()->calendar_id;

        $createdEvent = $service->events->insert(
            $calendarId,
            $event,
            ['conferenceDataVersion' => 1]
        );

        // ✅ NULL SAFE GOOGLE MEET KONTROLÜ
        $meetLink = null;

        if (
            $createdEvent->getConferenceData() &&
            isset($createdEvent->getConferenceData()->getEntryPoints()[0])
        ) {
            $meetLink = $createdEvent
                ->getConferenceData()
                ->getEntryPoints()[0]
                ->getUri();
        }

        return back()->with([
            'success' => $meetLink
                ? '✅ Etkinlik ve Google Meet linki oluşturuldu!'
                : '✅ Etkinlik oluşturuldu (Meet yetkisi yok)',
            'meet_link' => $meetLink
        ]);
    }


}

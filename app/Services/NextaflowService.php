<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pushes form submissions to Nextaflow (GoHighLevel / LeadConnector API v2).
 *
 * Every submission upserts a contact in the configured location, tags it with
 * the form it came from, and attaches a note containing the submitted fields.
 * Failures are logged and never thrown, so a CRM outage can't break a form.
 */
class NextaflowService
{
    public function submitForm(string $form, array $contact, array $details = []): void
    {
        $config = config('services.nextaflow');

        if (empty($config['api_key']) || empty($config['location_id'])) {
            Log::warning('Nextaflow: missing API key or location id, skipping submission.', ['form' => $form]);
            return;
        }

        try {
            $client = Http::baseUrl($config['base_url'])
                ->withToken($config['api_key'])
                ->withHeaders(['Version' => $config['version']])
                ->acceptJson()
                ->timeout(10);

            [$firstName, $lastName] = $this->splitName($contact['name'] ?? null);

            $response = $client->post('/contacts/upsert', array_filter([
                'locationId' => $config['location_id'],
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $contact['email'] ?? null,
                'phone' => $contact['phone'] ?? null,
                'source' => 'Website - ' . $form,
            ]))->throw();

            $contactId = $response->json('contact.id');
            if (!$contactId) {
                Log::warning('Nextaflow: upsert returned no contact id.', ['form' => $form, 'body' => $response->json()]);
                return;
            }

            $client->post("/contacts/{$contactId}/tags", [
                'tags' => ['website', 'form: ' . $form],
            ])->throw();

            if ($details) {
                $client->post("/contacts/{$contactId}/notes", [
                    'body' => $this->formatNote($form, $details),
                ])->throw();
            }
        } catch (Throwable $e) {
            Log::error('Nextaflow: form submission failed.', ['form' => $form, 'error' => $e->getMessage()]);
        }
    }

    private function splitName(?string $name): array
    {
        $parts = preg_split('/\s+/', trim((string) $name), 2);

        return [$parts[0] ?: null, $parts[1] ?? null];
    }

    private function formatNote(string $form, array $details): string
    {
        $lines = ["{$form} submission"];
        foreach ($details as $label => $value) {
            if ($value === null || $value === '' || $value === []) {
                continue;
            }
            $lines[] = $label . ': ' . (is_array($value) ? implode(', ', $value) : $value);
        }

        return implode("\n", $lines);
    }
}

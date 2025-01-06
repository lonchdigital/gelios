<?php

namespace App\Services\Site;

use App\Models\Page;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactsService 
{

    public function getFilteredItems(Request $request): array
    {
        $query = Contact::query();

        if ( !is_null($request['query']['search']) ) {
            $searchTerm = str_replace(' ', '\s*', $request['query']['search']);
            $searchTerm = preg_replace('/\s+/', ' ', $searchTerm);

            $query->where(function ($query) use ($searchTerm) {
                // translations table
                $query->whereHas('translations', function ($query) use ($searchTerm) {
                    $query->where('city', 'REGEXP', '.*' . $searchTerm . '.*');
                    $query->orWhere('street', 'REGEXP', '.*' . $searchTerm . '.*');
                });
            });
        }

        $contactsToDisplay = $this->getItemsAdditional($query->get());

        // dd($contactsToDisplay);

        return [
            'items' => $contactsToDisplay
        ];
    }

    private function getItemsAdditional($contacts)
    {
        foreach($contacts as $contact) {
            $emails = [];
            $phones = [];

            preg_match('/src="([^"]+)"/', $contact->iframe, $matches);
            if (!empty($matches[1])) {
                $iframeSrc = $matches[1];
                $directLink = str_replace('/embed?', '/?', $iframeSrc);
                $contact->setAttribute('iframe_src', $directLink);
            } else {
                $contact->setAttribute('iframe_src', '##');
            }

            foreach($contact->items->where('type', 'email') as $email) {
                $emails[] = $email;
            }
            foreach($contact->items->where('type', 'phone') as $phone) {
                $phones[] = $phone;
            }
        
            $contact->setAttribute('emails', $emails);
            $contact->setAttribute('phones', $phones);
        }

        return $contacts;
    }

}
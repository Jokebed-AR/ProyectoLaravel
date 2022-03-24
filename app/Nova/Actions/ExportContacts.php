<?php

namespace App\Nova\Actions;

use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportContacts extends DownloadExcel implements WithMapping
{
    /**
     * @param Contact $contact
     *
     * @return array
     */
    public function map($contact): array
    {
        return [
            $contact->id,
            $contact->name,
            $contact->email,
            $contact->phone,
            $contact->shipping_place,
            $contact->substance_to_store,
            $contact->quantity,
            $contact->sector,
            $contact->message,
            implode(', ', $contact->products()->pluck('name')->toArray()),
            $contact->created_at
        ];
    }
}

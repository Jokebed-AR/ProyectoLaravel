<?php

namespace App\Nova\Actions;

use App\Models\Newsletter;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportNewsletters extends DownloadExcel implements WithMapping
{
    /**
     * @param Newsletter $newsletter
     *
     * @return array
     */
    public function map($newsletter): array
    {
        return [
            $newsletter->email,
            $newsletter->is_available,
            $newsletter->created_at
        ];
    }
}

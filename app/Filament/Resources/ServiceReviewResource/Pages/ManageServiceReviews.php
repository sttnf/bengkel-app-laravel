<?php

namespace App\Filament\Resources\ServiceReviewResource\Pages;

use App\Filament\Resources\ServiceReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageServiceReviews extends ManageRecords
{
    protected static string $resource = ServiceReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

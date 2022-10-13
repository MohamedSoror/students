<?php

namespace App\Nova\Actions;

use App\Imports\UsersImport;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Anaseqal\NovaImport\Actions\Action;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportUsers extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $standalone = true;
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        Excel::import(new UsersImport, $fields->file);
        return Action::message('تم رفع الملف بنجاح.');
    }

    public function fields()
    {
        return [
            File::make('File')
                ->rules('required'),
        ];
    }
}

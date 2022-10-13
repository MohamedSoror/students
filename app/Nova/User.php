<?php

namespace App\Nova;

use App\Rules\NameRule;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use App\Nova\Actions\ImportUsers;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsTo;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'collage_email', 'personal_email', 'phone', 'another_phone', 'identify_num', 'date_of_birth', 'category_id'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('القسم', 'category', 'App\Nova\Category'),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', new NameRule(4)),
            Text::make('الايميل الاكاديمي', 'collage_email')
            ->creationRules('unique:users,collage_email')
            ->updateRules('unique:users,collage_email,{{resourceId}}'),
            Text::make('الايميل الشخصي', 'personal_email')
            ->creationRules('nullable', 'unique:users,personal_email')
            ->updateRules('nullable','unique:users,personal_email,{{resourceId}}'),
            Number::make('رقم الموبايل', 'phone')->rules('nullable', 'min:11', 'max:11')
            ->creationRules('nullable','unique:users,phone')
            ->updateRules('nullable','unique:users,phone,{{resourceId}}'),
            Number::make('رقم موبايل اضافي', 'another_phone')->rules('nullable', 'min:11', 'max:11')
            ->creationRules('nullable','unique:users,another_phone')
            ->updateRules('nullable','unique:users,another_phone,{{resourceId}}'),
            Number::make('الرقم القومي', 'identify_num')->rules('nullable', 'min:14', 'max:14')
            ->creationRules('unique:users,identify_num')
            ->updateRules('unique:users,identify_num,{{resourceId}}'),
            Date::make('تاريخ الميلاد', 'date_of_birth'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
            new ImportUsers
        ];
    }

    public static function label()
    {
        return "الطلاب";
    }

    public static function singularLabel()
    {
        return "طالب";
    }
}

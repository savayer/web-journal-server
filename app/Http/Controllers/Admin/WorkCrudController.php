<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\WorkRequest as StoreRequest;
use App\Http\Requests\WorkRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PortfolioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorkCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Work');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/work');
        $this->crud->setEntityNameStrings('work', 'works');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in PortfolioRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        /**
         * Columns
         */
        $this->crud->removeColumn('content'); 
        $this->crud->removeColumn('slug'); 
        $this->crud->addColumn([
            'name' => 'image',
            'label' => "Image",
            'type' => 'image',
             // 'prefix' => 'folder/subfolder/',
             // optional width/height if 25px is not ok with you             
            'height' => 'auto',
            'width' => '80px',
        ])->beforeColumn('name');        
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Title',
            'type' => 'link_text'
        ]);        
        
        /**
         * Fields
         */
        $this->crud->addField([
            'name' => 'name',
            'label' => "Name",
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'label' => "Slug",
            'type' => 'text',
        ]);

        $this->crud->addField([ // image
            'label' => "Image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
        ])->afterField('slug');

        $this->crud->addField(
            [   // TinyMCE
                'name' => 'content',
                'label' => 'Content',
                'type' => 'summernote',        
            ]
        );
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}

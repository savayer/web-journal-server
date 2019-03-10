<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArticleRequest as StoreRequest;
use App\Http\Requests\ArticleRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Article');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in ArticleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

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
        ])->beforeColumn('postTitle');
        $this->crud->addColumn([
            'name' => 'introtext',
            'label' => 'Introtext'
        ]);
        $this->crud->addColumn([
            'name' => 'postTitle',
            'label' => 'Title'
        ]);        

        $this->crud->addField([
            'name' => 'postTitle',
            'label' => "Post title",
            'type' => 'text',
        ]);

        $this->crud->addField([ // image
            'label' => "Post Image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
        ]);

        $this->crud->addField(
            [   // TinyMCE
                'name' => 'content',
                'label' => 'Content',
                'type' => 'tinymce'
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

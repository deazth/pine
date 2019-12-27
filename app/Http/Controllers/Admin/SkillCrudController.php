<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkillRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SkillCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SkillCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Skill');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/skill');
        $this->crud->setEntityNameStrings('skill', 'skills');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters

        $this->crud->addColumn([
        'label' => "Skill Category",
        'name' => 'skill_cat_id',
        'type' => 'select',
        'entity' => 'skillCat',
        'attribute' => 'name',

        ]);

        $this->crud->setFromDb();
            $this->crud->removeColumn('govern_by'); // remove a column from the table
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SkillRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        /*
                $this->crud->addColumn([
           'label' => "Location",
           'type' => 'select',
           'name' => 'location_id',
           'entity' => 'id',
           'attribute' => 'title',
           'model' => "App\Models\SkillCat"
        ]);
        */

        $this->crud->addField([
          'name' => 'name',
  'type' => 'text',
  'label' => "Skill Name"
]);

$this->crud->addField([
  'label' => "Skill Category",
'name' => 'skill_cat_id',
'type' => 'select',

'entity' => 'skillCat',
'attribute' => 'name',
'model' => "App\Models\SkillCat"
]);




        $this->crud->addField([
    'name' => 'descr',
    'type' => 'text',
    'label' => "Skill Description"
  ]);

        $this->crud->addField([
          'name' => 'govern_by',
          'type' => 'text',
          'label' => "Governing Body"
]);

        //$this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

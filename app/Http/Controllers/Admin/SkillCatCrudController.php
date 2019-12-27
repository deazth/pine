<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkillCatRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SkillCatCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SkillCatCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\SkillCat');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/skillcat');
        $this->crud->setEntityNameStrings('skillcat', 'Skill Category');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {

        $this->crud->setValidation(SkillCatRequest::class);

        $this->crud->addField([
          'name' => 'name',
          'type' => 'text',
          'label' => "Skill Category"
          ]);


          $this->crud->addField([
            'name' => 'descr',
            'type' => 'text',
            'label' => "Category Description"
          ]);

        //$this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

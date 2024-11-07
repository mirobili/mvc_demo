<?php


namespace App\Controllers;

use App\Entities\Contract;
use App\Entities\Customer;
use App\Framework\_deleteme\Request;
use App\Framework\Controller;
use App\Framework\DB;
use App\Framework\Entity;
use App\Models\CustomerModel;
use App\Views\Components\HtmlDetails;
use App\Views\Components\HtmlTable;
use App\Views\ContractDetailsView;
use App\Views\ContractsListView;
use App\Views\CustomerDetailsView;
use App\Views\CustomerFormView;
use App\Views\Templates\CustomerListView;


class CustomerControllerDemo extends Controller
{
    public function form($id = '')
    {
        $customer = new CustomerModel($id);
        $data  = $customer->toArray();
        $data['__form_action'] = '/customer_demo/save';

        return CustomerFormView::render($data);
    }

    public function customer_details_view($customer_id = '')
    {
        $customer = CustomerModel::get($customer_id);

//        dd($customer);
        $data  = $customer->toArray();
       // dd($data);

        // $data['__form_action'] = '/customer_demo/save';
        //    return HtmlDetails::render($data);
        $html='';
        $html.= CustomerDetailsView::render($data);

        return $html;
    }

    public function details($customer_id = ''): string
    {


        $html = '';

        $html .= $this->customer_details_view($customer_id);

        $html .= '<br><br><br>';
        // $html.= $this->customer_details_view($id);
        $contract_id = $_REQUEST['contract_id'] ?? 0;
        if ($contract_id) {
            $html .= $this->contract_details_view($contract_id);
        }

        $html .= $this->cutomer_contracts_view($customer_id);

        return $html;

    }

    public function contract_details_view($contract_id): string
    {
        $html = '';
        $data = [];
        if ($contract_id) {
            $contract = Contract::get($contract_id);
            $data = $contract->toArray();
        }

        $html .= ContractDetailsView::render($data);

        return $html;
    }

    public function add_contract($id = '', $contract_id=0)
    {
        $html='';


        $customer = Customer::get($id);
//        $data  = $customer->toArray();
//        // $data['__form_action'] = '/customer_demo/save';
//        //    return HtmlDetails::render($data);
//
//
//        $html.= CustomerDetailsView::render($data);
//        $html.='<br><br><br>';
//

         $html.= $this->details($id);
      //  return $html;

        /********************************************/
         $html.='<br><br><br>';
         $html.= $this->contract_details_view($contract_id);

        $html.='<br><br><br>';

        /********************************************/
        $contracts_data = $customer->getContracts($id);

        $array=[];
        foreach ($contracts_data as $contract) {
            $array[]=$contract->toArray();
        }

        $html.= ContractsListView::render( $array);

        return $html;
    }

    public function save($array)
    {
        $customer = Customer::makeFromArray($array);
        $customer->save();

        return ($customer->toArray());
    }

    public function create()
    {
        return $this->view('user/create');
    }


    public function list($request  =[])
    {
        $name = $request['name'] ?? '';
        $criteria = ['name' => '%' . $name . '%' ?? ''];

        $customers = Customer::find($criteria);
        $html = '';
        $html .= HtmlTable::render($customers, $names = [], 'Customers List from DB');

        return $html;
    }

    public function get_customer($id = 0)
    {
        $customer = Customer::get($id);
        return $customer->toArray();
    }

    public function get_entity($class,$id)
    {
        $entity= Entity::getEntity($class,$id);
        return $entity->toArray();
    }


//    public function edit()
//    {
//        $id = 123;
//        $user = UserEntity::findByID($id);
//        if ($user) {
//            $user->setEmail('mirobili@data.bg');
//            $user->save();
//            $message = 'User updated';
//        } else {
//            $message = 'User not found';
//        }
//
//        return $this->view('user/edit', ['message' => $message]);
//    }

    public function show()
    {
        return $this->view('user/show');
    }

//    public function delete()
//    {
//        return $this->view('user/delete');
//    }

    public function cutomer_contracts_view(mixed $id): string
    {

        $html='';
        $customer = Customer::get($id);
        $contracts_data = $customer->getContracts();

        $array = [];
        foreach ($contracts_data as $contract) {
            $array[] = $contract->toArray();
        }

        $html .= ContractsListView::render($array);

        return $html;
    }
}